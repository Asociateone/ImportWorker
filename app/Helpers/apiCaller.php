<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Symfony\Component\Dotenv\Dotenv;

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

        $dotenv = new Dotenv();
        $dotenv->loadEnv('./.env');
    }

    public function call(string $link)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);


        try {
            $response = $client->request('POST', $link, [
                'form_params' => [
                    'client_id' => $_ENV['AMAZON_CLIENT_ID'],
                    'client_secret' => $_ENV['AMAZON_SECRET_CLIENT_ID'],
                    'grant_type' => $_ENV['GRANT_TYPE'],
                ],
            ]);

            print_r($response);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}