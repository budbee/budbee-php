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
class IntervalApi
{
    private $apiClient;

    function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Get intervals
     * @param string $country Country code
     * @param string $postalCode The postalcode to get intervals for
     * @param int $n The number of intervals you want to get
     * @return array[\Budbee\Model\OrderIntervalResponse]
     */
    public function getIntervals($country, $postalCode, $n)
    {
        //parse inputs
        $resourcePath = "/intervals/{country}/{postalCode}/{n}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v2+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v2+json'
        );

        if (null != $n) {
            $resourcePath = str_replace("{country}", $this->apiClient->toPathValue($country), $resourcePath);
            $resourcePath = str_replace("{postalCode}", $this->apiClient->toPathValue($postalCode), $resourcePath);
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

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderIntervalResponse]');
        return $responseObject;
    }

    /**
     * Get intervals
     * @param string $postalCode The postalcode to get intervals for
     * @param int $n The number of intervals you want to get
     * @return array[\Budbee\Model\OrderIntervalResponse]
     * @deprecated deprecated in favour of getIntervals($country, $postalCode, $n)
     */
    public function getIntervals($postalCode, $n)
    {
        //parse inputs
        $resourcePath = "/intervals/{postalCode}/{n}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v2+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v2+json'
        );

        if (null != $n) {
        	$resourcePath = str_replace("{postalCode}", $this->apiClient->toPathValue($postalCode), $resourcePath);
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

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderIntervalResponse]');
        return $responseObject;
    }

    /**
     * Get intervals
     * @param string $country Country code
     * @param string $postalCode The postalcode to get intervals for
     * @param string $date Get all intervals up to and including this date in format "YYYY-MM-DD".
     * @return array[\Budbee\Model\OrderInterval]
     */
    public function getIntervalsToDate($country, $postalCode, $date)
    {
        //parse inputs
        $resourcePath = "/intervals/{country}/{postalCode}/{date}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v2+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v2+json'
        );

        if (null != $date) {
            $resourcePath = str_replace("{country}", $this->apiClient->toPathValue($country), $resourcePath);
            $resourcePath = str_replace("{postalCode}", $this->apiClient->toPathValue($postalCode), $resourcePath);
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

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderIntervalResponse]');
        return $responseObject;
    }

    /**
     * Get intervals
     * @param string $postalCode The postalcode to get intervals for
     * @param string $date Get all intervals up to and including this date in format "YYYY-MM-DD".
     * @return array[\Budbee\Model\OrderInterval]
     * @deprecated deprecated in favour of getIntervalsToDate($country, $postalCode, $date)
     */
    public function getIntervalsToDate($postalCode, $date)
    {
        //parse inputs
        $resourcePath = "/intervals/{postalCode}/{date}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.intervals-v2+json',
            'Content-Type' => 'application/vnd.budbee.intervals-v2+json'
        );

        if (null != $date) {
        	$resourcePath = str_replace("{postalCode}", $this->apiClient->toPathValue($postalCode), $resourcePath);
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

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\OrderIntervalResponse]');
        return $responseObject;
    }
}

