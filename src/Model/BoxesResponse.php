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
 * @author Andrii Cherednichenko
 */
class BoxesResponse implements JsonSerializable
{
  static $dataTypes = array(
    'id' => 'string',
    'name' => 'string',
    'directions' => 'string',
    'label' => 'string',
    'distance' => 'int',
    'address' => '\Budbee\Model\Address',
  );

  /**
   * Box id
   * @var string
   */
  public $id;

  /**
   * Box name
   * @var string
   */
  public $name;

  /**
   * Box directions
   * @var string
   */
  public $directions;

  /**
   * Box label
   * @var string
   */
  public $label;

  /**
   * Box distance
   * @var int
   */
  public $distance;

  /**
   * Delivery interval
   * @var \Budbee\Model\Address
   */
  public $address;

  public function jsonSerialize(): mixed
  {
    return array(
      'id' => $this->id,
      'name' => $this->name,
      'directions' => $this->directions,
      'label' => $this->label,
      'distance' => $this->distance,
      'address' => $this->address,
    );
  }
}
