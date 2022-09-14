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
    }

    public function call()
    {
        $ch = curl_init("https://id.twitch.tv/oauth2/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        echo $output;
    }
}