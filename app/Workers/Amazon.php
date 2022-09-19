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
    public function getToken(): string
    {
        $test = new apiCaller('https://id.twitch.tv/', $_ENV);

        $call = json_decode($test->call('oauth2/token'), true);

        return $call['access_token'];
    }
}