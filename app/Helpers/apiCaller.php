<?php

namespace App\Helpers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class apiCaller
{
    private string $url;
    private string $client_id;
    private string $secret_client_id;
    private string $grant_type;

    /**
     * @return void
     */
    public function __construct(string $url, $env)
    {
        $this->url = $url;
        $this->client_id = $env['AMAZON_CLIENT_ID'];
        $this->secret_client_id = $env['AMAZON_SECRET_CLIENT_ID'];
        $this->grant_type = $env['GRANT_TYPE'];
    }

    /**
     * @param string $link
     * @throws GuzzleException
     */
    public function call(string $link)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $response = $client->request('POST', $link, [
                'form_params' => [
                    'client_id' => $this->client_id,
                    'client_secret' => $this->secret_client_id,
                    'grant_type' => $this->grant_type
                ],
            ]);

            return $response->getBody();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}