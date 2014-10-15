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

/**
 * @author Nicklas Moberg
 */
class PostalcodesApi
{
    private $apiClient;

    function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
    }

    /**
     * Check Postalcode
     * @param string $postalcode Postalcode to validate
     * @return \Budbee\Model\GenericResponse
     */
    public function checkPostalCode($postalcode) {
        //parse inputs
        $resourcePath = "/postalcodes/validate/{postalcode}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.postalcodes-v1+json',
            'Content-Type' => 'application/vnd.budbee.postalcodes-v1+json'
        );

        if (null != $postalcode) {
            $resourcePath = str_replace("{postalcode}", $this->apiClient->toPathValue($postalcode), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, '\Budbee\Model\GenericResponse');
        return $responseObject;
    }

    /**
     * Get Postalcodes
     * @return array[string]
     */
    public function getPostalCodes() {
        //parse inputs
        $resourcePath = "/postalcodes";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.postalcodes-v1+json',
            'Content-Type' => 'application/vnd.budbee.postalcodes-v1+json'
        );

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

