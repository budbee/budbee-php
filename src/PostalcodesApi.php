<?php
/**
 *  Copyright 2014 Budbee AB.
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

/**
 * @author Nicklas Moberg
 */
class PostalcodesApi
{
    private $apiClient;

    function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Check Postalcode
     * @param string $country Country code
     * @param string $postalcode Postalcode to validate
     * @return array[\Budbee\Model\CollectionPoint] An array of collectionpoints in range of the postalcode
     */
    public function checkPostalCode($country, $postalcode)
    {
        //parse inputs
        $resourcePath = "/postalcodes/validate/{country}/{postalcode}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.postalcodes-v2+json',
            'Content-Type' => 'application/vnd.budbee.postalcodes-v2+json'
        );

        if (null != $country) {
            $resourcePath = str_replace("{country}", $this->apiClient->toPathValue($country), $resourcePath);
        }

        if (null != $postalcode) {
            $resourcePath = str_replace("{postalcode}", $this->apiClient->toPathValue($postalcode), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return false;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\CollectionPoint]');

        return $responseObject;
    }

    /**
     * Get Postalcodes
     * @param string country Country code to request
     * @return array[string]
     */
    public function getPostalCodes($country)
    {
        //parse inputs
        $resourcePath = "/postalcodes/{country}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.postalcodes-v1+json',
            'Content-Type' => 'application/vnd.budbee.postalcodes-v1+json'
        );

        if (null != $country) {
            $resourcePath = str_replace("{country}", $this->apiClient->toPathValue($country), $resourcePath);
        }

        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[string]');
        return $responseObject;
    }
}

