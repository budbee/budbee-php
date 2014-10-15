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
class Dimensions
{
    static $dataTypes = array(
        'width' => 'int',
        'length' => 'int',
        'height' => 'int',
        'weight' => 'int'
    );

    /**
    * Width of shipment in cm.
    * @var int
     */
    public $width;

    /**
    * Length of shipment in cm.
    * @var int
     */
    public $length;

    /**
    * Height of shipment in cm.
    * @var int
     */
    public $height;

    /**
    * Weight of shipment in cm.
    * @var int
     */
    public $weight;
}

