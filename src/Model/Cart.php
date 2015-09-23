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
class Cart implements JsonSerializable
{
    static $dataTypes = array(
        'cartId' => 'string',
        'articles' => 'array[\Budbee\Model\Article]',
        'dimensions' => '\Budbee\Model\Dimensions'
    );

    /**
     * The cart ID of the end users purchase
     * @var string
     */
    public $cartId;

    /**
     * List of articles belonging to this cart.
     * @var array[\Budbee\Model\Article]
     */
    public $articles;

    /**
     * The dimensions of the entire shipment.
     * @var \Budbee\Model\Dimensions
     */
    public $dimensions;

    public function jsonSerialize()
    {
    	return array(
    		'cartId' => $this->cartId,
    		'articles' => $this->articles,
    		'dimensions' => $this->dimensions
    	);
    }
}
