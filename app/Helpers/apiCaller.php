<?php

namespace App\Helpers;

use Dotenv\Dotenv;

class apiCaller
{
    private string $url;
    private string $client_id;
    private string $token;


    /**
     * @return void
     */
    public function __construct(string $url, string $client_id)
    {
        $this->url = $url;
        $this->client_id = $client_id;

        //load in env file
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    public function call()
    {
        $ch = curl_init("https://id.twitch.tv/oauth2/");
        getenv("COMPOSER");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        echo $output;
    }
}