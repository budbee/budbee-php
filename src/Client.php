<?php
/**
 *  Copyright 2014 Sendus Sverige AB.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
namespace Budbee;

use Budbee\Exception\BudbeeException;

/**
 * @author Nicklas Moberg
 */
class Client
{
    public static $PRODUCTION = 'https://api.budbee.com'; // Production url
    public static $SANDBOX = 'https://sandbox.api.budbee.com'; // Sandbox url
    public static $DEVELOPMENT = 'http://localhost:9300'; // Internal development

    public static $POST = 'POST';
    public static $GET = 'GET';
    public static $PUT = 'PUT';
    public static $DELETE = 'DELETE';

    /**
     * @param string $apiKey API key
     * @param string $secretKey secret key
     * @param string $env Environment
     */
    function __construct($apiKey, $secretKey, $env = null) {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->env = null != $env ? $env : static::$PRODUCTION;
    }

    /**
     * @param string $resourcePath path to method endpoint
     * @param string $method method to call
     * @param array $queryParams parameters to be place in query URL
     * @param mixed $postData parameters to be placed in POST body
     * @param array $headerParams parameters to be place in request header
     * @throws BudbeeException
     * @return mixed
     */
    public function callAPI($resourcePath, $method, $queryParams, $postData, $headerParams) {
        $headers = array();

        if ($headerParams != null) {
            foreach ($headerParams as $key => $val) {
                $headers[] = "$key: $val";
            }
        }

        $url = $this->env . $resourcePath;

        if (is_object($postData) or is_array($postData)) {
            $postData = json_encode($this->sanitizeForSerialization($postData));
        }

        # Add authorization header
        $timestamp = $this->getTimestamp();
        $nonce = $this->getNonce(20);
        $signature = $this->computeSignature($this->secretKey, $method, $timestamp, $nonce, $url, $postData);

        $headers = array_merge($headers, $this->getAuthHeaders($timestamp, $nonce, $this->apiKey, $signature));

        if (!empty($queryParams)) {
            $url = $url . '?' . http_build_query($queryParams);
        }

        $curl = $this->configureCurl(curl_init(), $headers, $method, $postData, $url);

        // Make the request
        $response = $this->send($curl);

        // Handle the response
        $data = $this->handleResponse($response->data, $response->info, $url);

        return $data;
    }

    /**
     * Build a JSON POST object
     * @param mixed $data
     * @return string|array
     */
    protected function sanitizeForSerialization($data)
    {
        if (is_scalar($data) || null == $data) {
            $sanitized = $data;
        } else if ($data instanceof \DateTime) {
            $sanitized = $data->format('U') * 1000;
        } else if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = $this->sanitizeForSerialization($value);
            }
            $sanitized = $data;
        } else if (is_object($data)) {
            $values = array();
            foreach (array_keys($data::$dataTypes) as $property) {
                $values[$property] = $this->sanitizeForSerialization($data->$property);
            }
            $sanitized = $values;
        } else {
            $sanitized = (string) $data;
        }

        return $sanitized;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in the path, by url-encoding.
     * @param string $value a string which will be part of the path
     * @return string the serialized object
     */
    public static function toPathValue($value) {
        return rawurlencode($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in the query, by imploding comma-separated if it's an
     * object. If it's a string, pass through unchanged. It will be url-encoded later.
     * @param object $object an object to be serialized to a string
     * @return string the serialized object
     */
    public static function toQueryValue($object) {
        if (is_array($object)) {
            return implode(',', $object);
        } else {
            return $object;
        }
    }

    /**
     * Just pass through the header value for now. Placeholder in case we find out we need to do something with header
     * values.
     * @param string $value a string which will be part of the header
     * @return string the header string
     */
    public static function toHeaderValue($value) {
        return $value;
    }

    /**
     * Deserialize a JSON string into an object.
     * @param object $data object or primitive to be deserialized
     * @param string $class class name is passed as a string
     * @return object an instance of $class
     */
    public static function deserialize($data, $class)
    {
        if (null == $data) {
            $deserialized = null;
        } elseif ('array[' == substr($class, 0, 6)) {
            $subClass = substr($class, 6, -1);
            $values = array();
            foreach ($data as $value) {
                $values[] = static::deserialize($value, $subClass);
            }
            $deserialized = $values;
        } elseif ('\DateTime' == $class) {
            $deserialized = new \DateTime('@' . ($data / 1000), new \DateTimeZone('UTC'));
        } elseif (in_array($class, array('string', 'int', 'float', 'bool'))) {
            settype($data, $class);
            $deserialized = $data;
        } else {
            $instance = new $class();
            foreach ($instance::$dataTypes as $property => $type) {
                if (isset($data->$property)) {
                    $instance->$property = static::deserialize($data->$property, $type);
                }
            }
            $deserialized = $instance;
        }

        return $deserialized;
    }

    private function getTimestamp()
    {
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        return (string) $now->format(\DateTime::RFC1123);
    }

    private function getNonce($length, $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $randString = '';
        for ($i = 0; $i < $length; $i++) {
            $randString .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $randString;
    }

    private function computeSignature($key, $method, $date, $nonce, $url, $body)
    {
        $data = $method . "\n";
        $data .= "date:$date" . "\n";
        $data .= "nonce:$nonce" . "\n";
        $data .= $url;

        if (null != $body) {
            $data .= "\n" . $body;
        }

        return base64_encode(hash_hmac('sha1', $data, $key, true));
    }

    private function getAuthHeaders($timestamp, $nonce, $apiKey, $signature)
    {
        return array(
            "X-HMAC-Date: $timestamp",
            "X-HMAC-Nonce: $nonce",
            "Authorization: HmacSHA1 $apiKey $signature"
        );
    }

    private function configureCurl($ch, $headers, $method, $postData, $url)
    {
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // return the result on success, rather than just TRUE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Need to reset `Expect` header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($headers, array('Expect:')));

        if ($method == static::$POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == static::$PUT) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == static::$DELETE) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        } else if ($method != static::$GET) {
            throw new BudbeeException('Method ' . $method . ' is not recognized.');
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        return $ch;
    }

    private function handleResponse($response, $response_info, $url)
    {
        if (0 == $response_info['http_code']) {
            throw new BudbeeException('TIMEOUT: api call to ' . $url . ' took more than 5s to return');
        } else if (200 == $response_info['http_code']) {
            $data = json_decode($response);
        } else if (204 == $response_info['http_code']) {
            $data = true;
        } else if (401 == $response_info['http_code']) {
            throw new BudbeeException('Unauthorized API request to ' . $url . ': ' . $response);
        } else if (404 == $response_info['http_code']) {
            $data = null;
        } else if (422 == $response_info['http_code']) {
        	throw new BudbeeException('Validation errors: ' . $response);
        } else {
            throw new BudbeeException('Can\'t connect to the api: ' . $url . ' response code: ' . $response_info['http_code'] . "\n" . $response);
        }

        return $data;
    }

    private function send($ch)
    {
        $response = new \stdClass();
        $response->data = curl_exec($ch);
        $response->info = curl_getinfo($ch);

        return $response;
    }
}
