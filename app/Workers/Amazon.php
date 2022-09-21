<?php

namespace App\Workers;

use App\Helpers\apiCaller;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Dotenv\Dotenv;

Class Amazon {
    /**
     * @return void
     */
    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv('./.env');
    }

    /**
     * @return string
     * @throws GuzzleException
     */
    private function getToken(): string
    {
        $apiCall = new apiCaller('https://id.twitch.tv/', $_ENV);

        $call = json_decode($apiCall->callAuth('oauth2/token'), true);

        return $call['access_token'];
    }

    public function getGames(): array
    {
        $apiCall = new apiCaller('https://api.igdb.com/', $_ENV);

        $items = $apiCall->callBearer('v4/games', $this->getToken(), 'fields cover,url,name; search "pokemon"; limit 50;');

        $arrayGames = json_decode($items, true);

        print(count($arrayGames));

        return [];
    }
}