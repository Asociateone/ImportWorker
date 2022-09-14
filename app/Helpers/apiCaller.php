<?php

namespace App\Helpers;

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
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    public function call()
    {
        echo getenv("TEST");
//        $ch = curl_init("https://id.twitch.tv/oauth2/");
//        $output = curl_exec($ch);
//        echo $output;
    }
}