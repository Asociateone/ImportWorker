<?php

namespace App\Workers;

use App\Helpers\apiCaller;
use Symfony\Component\Dotenv\Dotenv;

Class Amazon {

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv('./.env');
    }

    public function apiCall()
    {
        $test = new apiCaller('https://id.twitch.tv/', $_ENV);

        $test->call('oauth2/token');
    }
}