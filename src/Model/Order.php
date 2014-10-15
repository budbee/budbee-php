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
namespace Budbee\Model;

/**
 * @author Nicklas Moberg
 */
class Order
{
    static $dataTypes = array(
        'id' => 'string',
        'interval' => '\Budbee\Model\OrderInterval',
        'cart' => '\Budbee\Model\Cart',
        'edi' => '\Budbee\Model\EDI',
        'collection' => '\Budbee\Model\Contact',
        'delivery' => '\Budbee\Model\Contact'
    );

    /**
    * Order ID
    * @var string
     */
    public $id;

    /**
    * Order interval.
    * @var \Budbee\Model\OrderInterval
     */
    public $interval;

    /**
    * Cart
    * @var \Budbee\Model\Cart
     */
    public $cart;

    /**
    * EDI
    * @var \Budbee\Model\EDI
     */
    public $edi;

    /**
    * Collection contact information.
    * @var \Budbee\Model\Contact
     */
    public $collection;

    /**
    * Delivery contact information.
    * @var \Budbee\Model\Contact
     */
    public $delivery;
}

