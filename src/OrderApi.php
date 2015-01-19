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
class OrderApi
{
    private $apiClient;

    function __construct(Client $apiClient) {
        $this->apiClient = $apiClient;
    }

    /**
     * Create order(s)
     * @param array[\Budbee\Model\Order] $body
     * @return array[\Budbee\Model\Order]
     */
    public function createOrder($body) {
        //parse inputs
        $resourcePath = "/multiple/orders";
        $method = Client::$POST;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\Order]');
        return $responseObject;
    }

    /**
     * Edit an order
     * @param string $id ID of order to edit
     * @param \Budbee\Model\Order $body
     * @return \Budbee\Model\Order
     */
    public function editOrder($id, $body) {
        //parse inputs
        $resourcePath = "/multiple/orders/{id}";
        $method = Client::$PUT;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        if (null != $id) {
            $resourcePath = str_replace("{id}", $this->apiClient->toPathValue($id), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, '\Budbee\Model\Order');
        return $responseObject;
    }

    /**
     * Remove an order
     * @param string $id ID of order to remove
     * @return void
     */
    public function removeOrder($id) {
        //parse inputs
        $resourcePath = "/multiple/orders/{id}";
        $method = Client::$DELETE;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        if (null != $id) {
            $resourcePath = str_replace("{id}", $this->apiClient->toPathValue($id), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);
    }

    /**
     * Get an order
     * @param string $id \Budbee\Model\Order id
     * @return \Budbee\Model\Order
     */
    public function getOrder($id) {
        //parse inputs
        $resourcePath = "/multiple/orders/{id}";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        if (null != $id) {
            $resourcePath = str_replace("{id}", $this->apiClient->toPathValue($id), $resourcePath);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, '\Budbee\Model\Order');
        return $responseObject;
    }

    /**
     * Get orders
     * @return array[\Budbee\Model\Order]
     */
    public function getOrders() {
        //parse inputs
        $resourcePath = "/multiple/orders";
        $method = Client::$GET;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, 'array[\Budbee\Model\Order]');
        return $responseObject;
    }
}

