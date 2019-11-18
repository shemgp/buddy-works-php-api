<?php

declare(strict_types=1);
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at.
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Buddy\Apis;

use Buddy\BuddyClient;
use Buddy\BuddyResponse;
use Buddy\Exceptions\BuddySDKException;

class Api
{
    /**
     * @var BuddyClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $options;

    public function __construct(BuddyClient $client, array $options = [])
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * @throws BuddySDKException
     */
    protected function getJson(?string $accessToken, string $url, array $params = [], array $query = [], string $path = '/'): BuddyResponse
    {
        return $this->client->getJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query, $path));
    }

    /**
     * @throws BuddySDKException
     */
    protected function patchJson(?string $accessToken, array $patchData, string $url, array $params = [], array $query = [], string $path = '/'): BuddyResponse
    {
        return $this->client->patchJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query, $path), $patchData);
    }

    /**
     * @throws BuddySDKException
     */
    protected function deleteJson(?string $accessToken, ?array $deleteData, string $url, array $params = [], array $query = [], string $path = '/'): BuddyResponse
    {
        return $this->client->deleteJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query, $path), $deleteData);
    }

    /**
     * @throws BuddySDKException
     */
    protected function postJson(?string $accessToken, array $postData, string $url, array $params = [], array $query = [], string $path = '/'): BuddyResponse
    {
        return $this->client->postJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query, $path), $postData);
    }

    /**
     * @throws BuddySDKException
     */
    protected function putJson(?string $accessToken, array $putData, string $url, array $params = [], array $query = [], string $path = '/'): BuddyResponse
    {
        return $this->client->putJson($this->getAccessToken($accessToken), $this->client->createUrl($url, $params, $query, $path), $putData);
    }

    /**
     * @throws BuddySDKException
     *
     * @return string|mixed
     */
    protected function getAccessToken(?string $accessToken = null)
    {
        if (isset($accessToken)) {
            return $accessToken;
        }
        if (isset($this->options['accessToken'])) {
            return $this->options['accessToken'];
        }
        throw new BuddySDKException('No access token provided');
    }
}
