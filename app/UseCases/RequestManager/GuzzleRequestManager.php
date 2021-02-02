<?php

namespace App\UseCases\RequestManager;

use GuzzleHttp\Client;

class GuzzleRequestManager implements RequestManagerInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function load($url)
    {
        $response = $this->client->request('GET', $url);

        return $response->getBody();
    }
}
