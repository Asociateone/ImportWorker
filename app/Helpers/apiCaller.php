<?php

namespace App\Helpers;


use GuzzleHttp\Client;

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

    public function call(string $link)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);

        try {
            $response = $client->request('POST', $link);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}