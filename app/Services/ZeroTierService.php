<?php

namespace App\Services;

use App\Contracts\Services\ZeroTierServiceContract;
use GuzzleHttp\Client;
use Minicli\App;

class ZeroTierService implements ZeroTierServiceContract
{   
    private App $app; 

    private Client $client;

    private string $url = 'https://api.zerotier.com/api/v1/';

    public function load(App $app): void
    {
        $this->app = $app;
        $this->client = new Client([
            'base_uri' => $this->url,
            'headers' => [
                'Authorization' => 'token ' . $this->app->config->zerotier_token
            ]
        ]);
    }

    public function getNetworks(): array
    {
        return json_decode(
            $this->client->get('network')->getBody()->getContents()
        );
    }

    public function getMembers(string $network): array
    {
        return json_decode(
            $this->client->get('network/' . $network . '/member')->getBody()->getContents()
        );
    }
}

