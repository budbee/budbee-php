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
class Address implements JsonSerializable
{
    static $dataTypes = array(
        'street' => 'string',
        'street2' => 'string',
        'postalCode' => 'string',
        'city' => 'string',
        'country' => 'string'
    );

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $street2;

    /**
     * @var string
     */
    public $postalCode;

    /**
     * @var string
     */
    public $city;

    /**
     * Country code
     * @var string
     */
    public $country;

    public function jsonSerialize()
    {
    	return array(
    		'street' => $this->street,
    		'street2' => $this->street2,
    		'postalCode' => $this->postalCode,
    		'city' => $this->city,
    		'country' => $this->country
    	);
    }
}
