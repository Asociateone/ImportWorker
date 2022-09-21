<?php

namespace App\Helpers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class apiCaller
{
    private string $url;
    private string $client_id;
    private string $secret_client_id;
    private string $grant_type;

    /**
     * @return void
     */
    public function __construct(string $url, $env = null)
    {
        $this->url = $url;
        $this->client_id = $env['AMAZON_CLIENT_ID'];
        $this->secret_client_id = $env['AMAZON_SECRET_CLIENT_ID'];
        $this->grant_type = $env['GRANT_TYPE'];
    }

    /**
     * @param string $url
     * @return StreamInterface|void
     * @throws GuzzleException
     */
    public function callAuth(string $url)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $response = $client->request('POST', $url, [
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

    public function callBearer(string $url, string $bearer, string $body = null)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Authorization' => "Bearer $bearer",
                    'Client-ID' => $this->client_id,
                ],
                'body' => $body
            ]);

            return $response->getBody();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}