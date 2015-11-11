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
class CollectionPoint implements JsonSerializable
{
	static $dataTypes = array(
		'id' => 'int',
		'name' => 'string',
		'referencePerson' => 'string',
		'telephoneNumber' => 'string',
		'address' => '\Budbee\Model\Address',
		'doorCode' => 'string',
		'outsideDoor' => 'bool',
		'additionalInfo' => 'string'
	);

	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $referencePerson;

	/**
	 * @var string
	 */
	public $telephoneNumber;

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
	 * @var string
	 */
	public $additionalInfo;

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
