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
namespace Budbee\Model;

use \JsonSerializable;

/**
 * @author Nicklas Moberg
 */
class OrderInterval implements JsonSerializable
{
    static $dataTypes = array(
        'collection' => '\Budbee\Model\Interval',
        'delivery' => '\Budbee\Model\Interval'
    );

    /**
     * Collection interval
     * @var \Budbee\Model\Interval
     */
    public $collection;

    /**
     * Delivery interval
     * @var \Budbee\Model\Interval
     */
    public $delivery;

    public function __construct(\Budbee\Model\Interval $collection = null, \Budbee\Model\Interval $delivery = null)
    {
    	$this->collection = $collection;
    	$this->delivery = $delivery;
    }

    public function jsonSerialize()
    {
    	return array(
    		'collection' => $this->collection,
    		'delivery' => $this->delivery
    	);
    }
}
