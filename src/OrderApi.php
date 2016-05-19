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

use Budbee\Exception\BudbeeException;

/**
 * @author Nicklas Moberg
 */
class OrderApi
{
    private $apiClient;

    function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Create order
     * @param \Budbee\Model\OrderRequest $body
     * @throws \Budbee\Exception\BudbeeException if order is null
     * @return \Budbee\Model\Order
     */
    public function createOrder($body)
    {
        //parse inputs
        $resourcePath = "/multiple/orders";
        $method = Client::$POST;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v2+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v2+json'
        );

        //make the API Call
        if (!isset($body)) {
            throw new BudbeeException("Order cannot be null");
        }
        $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response, '\Budbee\Model\Order');
        return $responseObject;
    }

    /**
     * Create orders
     * @param array [\Budbee\Model\Order] $body
     * @throws \Budbee\Exception\BudbeeException if order array is null
     * @return array[\Budbee\Model\Order]
     */
    public function createOrders($body)
    {
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
            throw new BudbeeException("Orders cannot be null");
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
     * Deprecated
     */
    public function editOrder($id, $body)
    {
        throw new BudbeeException("`editOrder` has been deprecated. Please use `editDeliveryContact` and `editDeliveryAddress` to update an Order");
    }

    /**
     * Edit an the delivery contact of an order
     * @param string $id ID of order to edit
     * @param \Budbee\Model\Contact $body
     * @return \Budbee\Model\Order
     */
    public function editDeliveryContact($id, $body)
    {
        //parse inputs
        $resourcePath = "/multiple/orders/{id}";
        $method = Client::$PUT;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        if (!isset($id)) {
            throw new BudbeeException("Id cannot be null");
        }

        $resourcePath = str_replace("{id}", $this->apiClient->toPathValue($id), $resourcePath);

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
     * Edit an the delivery address of an order
     * @param string $id ID of order to edit
     * @param \Budbee\Model\Address $body
     * @return \Budbee\Model\Order
     */
    public function editDeliveryAddress($id, $body)
    {
        //parse inputs
        $resourcePath = "/multiple/orders/{id}/address";
        $method = Client::$PUT;
        $queryParams = array();
        $headerParams = array(
            'Accept' => 'application/vnd.budbee.multiple.orders-v1+json',
            'Content-Type' => 'application/vnd.budbee.multiple.orders-v1+json'
        );

        if (!isset($id)) {
            throw new BudbeeException("Id cannot be null");
        }

        $resourcePath = str_replace("{id}", $this->apiClient->toPathValue($id), $resourcePath);

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
    public function removeOrder($id)
    {
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
    public function getOrder($id)
    {
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
    public function getOrders()
    {
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

    private function arrayContainsNull($orders)
    {
        foreach ($orders as $order) {
            if (null == $order) {
                return true;
            }
        }

        return false;
    }
}

