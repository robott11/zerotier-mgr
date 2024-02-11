<?php

namespace App\Services;

use App\Contracts\Services\ZeroTierServiceContract;
use GuzzleHttp\Client;
use Minicli\App;

class ZeroTierService implements ZeroTierServiceContract
{   
    private App $app; 

    private Client $http_client;

    private string $url = 'https://api.zerotier.com/api/v1/';

    public function load(App $app): void
    {
        $this->app = $app;
        $this->http_client = new Client([
            'base_uri' => $this->url
        ]);
    }

    public function getNetwork(): array
    {
        $response = $this->sendRequest();
        return json_decode($response->getBody()->getContents());
    }

    private function sendRequest(string $method = 'GET')
    {
        $client = new Client();
        $response = $client->get('https://api.zerotier.com/api/v1/network', [
            'headers' => [
                'Authorization' => 'token ' . $this->app->config->zerotier_token
            ]
        ]);

        return $response;
    }
}
