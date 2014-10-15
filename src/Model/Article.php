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
class Article
{
    static $dataTypes = array(
        'name' => 'string',
        'reference' => 'string',
        'quantity' => 'int',
        'unitPrice' => 'int',
        'discountRate' => 'int',
        'taxRate' => 'int'
    );

    /**
    * Article name
    * @var string
     */
    public $name;

    /**
    * Article reference,
    * @var string
     */
    public $reference;

    /**
    * Quantity of article.
    * @var int
     */
    public $quantity;

    /**
    * Price of article excl. VAT
    * @var int
     */
    public $unitPrice;

    /**
    * Discount rate of article.
    * @var int
     */
    public $discountRate;

    /**
    * Tax rate of article.
    * @var int
     */
    public $taxRate;
}

