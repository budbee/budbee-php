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
class IntervalApi
{
    private $apiClient;

    function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
    }

    /**
     * Get intervals
     * @param int $n The number of intervals you want to get
     * @return array[\Budbee\Model\OrderInterval]
     */
    public function getIntervals($n) {
        //parse inputs
        $resourcePath = "/multiple/intervals/{n}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v1+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v1+json'
        );

        if (null != $n) {
            $resourcePath = str_replace("{n}", $this->apiClient->toPathValue($n), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderInterval]');
        return $responseObject;
    }

    /**
     * Get intervals
     * @param string $date Get all intervals up to and including this date in format "YYYY-MM-DD".
     * @return array[\Budbee\Model\OrderInterval]
     */
    public function getIntervalsToDate($date) {
        //parse inputs
        $resourcePath = "/multiple/intervals/{date}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v1+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v1+json'
        );

        if (null != $date) {
            $resourcePath = str_replace("{date}", $this->apiClient->toPathValue($date), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderInterval]');
        return $responseObject;
    }
}

