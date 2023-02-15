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

/**
 * @author Andrii Cherednichenko
 */
class BoxesApi
{
  private $apiClient;

  function __construct(Client $apiClient)
  {
    $this->apiClient = $apiClient;
  }

  /**
   * Get Boxes for current postal code.
   *
   * @param string $country Country code
   * @param string $postalcode Postalcode to validate
   * @return array[\Budbee\Model\BoxesResponse] An array of boxes
   */
  public function getBoxes($country, $postalcode)
  {
    //parse inputs
    $resourcePath = "/boxes/postalcodes/validate/{country}/{postalcode}";
    $method = Client::$GET;
    $queryParams = array();
    $headerParams = array(
      'Accept' => 'application/vnd.budbee.boxes-v1+json',
      'Content-Type' => 'application/vnd.budbee.boxes-v1+json',
    );

    if (null != $country) {
      $resourcePath = str_replace("{country}", $this->apiClient->toPathValue($country), $resourcePath);
    }

    if (null != $postalcode) {
      $resourcePath = str_replace("{postalcode}", $this->apiClient->toPathValue($postalcode), $resourcePath);
    }
    //make the API Call
    if (!isset($body)) {
      $body = null;
    }
    $response = $this->apiClient->callAPI($resourcePath, $method, $queryParams, $body, $headerParams);

    if (!$response) {
      return false;
    }

    return $this->apiClient->deserialize($response->lockers, 'array[\Budbee\Model\BoxesResponse]');
  }
}
