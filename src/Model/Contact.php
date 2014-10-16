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
class Contact
{
    static $dataTypes = array(
        'name' => 'string',
        'referencePerson' => 'string',
        'telephoneNumber' => 'string',
        'email' => 'string',
        'address' => '\Budbee\Model\Address',
        'doorCode' => 'string',
        'outsideDoor' => 'bool',
        'additionalInfo' => 'string'
    );

    /**
    * The name (or business name) for the contact.
    * @var string
     */
    public $name;

    /**
    * A reference person (e.g. if `name` is a company)
    * @var string
     */
    public $referencePerson;

    /**
    * @var string
     */
    public $telephoneNumber;

    /**
    * @var string
     */
    public $email;

    /**
    * @var \Budbee\Model\Address
     */
    public $address;

    /**
     * @var string
     */
    public $doorCode;

    /**
     * @var bool
     */
    public $outsideDoor;

    /**
    * Additional information about the customer, e.g. door code, can leave shipment outside door etc.
    * @var string
     */
    public $additionalInfo;
}

