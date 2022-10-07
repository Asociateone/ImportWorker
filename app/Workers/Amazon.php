<?php

namespace App\Workers;

use App\Helpers\apiCaller;
use App\Helpers\mysqlConnector;
use Symfony\Component\Dotenv\Dotenv;
use GuzzleHttp\Exception\GuzzleException;

Class Amazon {

    private string $token;

    /**
     * @throws GuzzleException
     */
    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv('./.env');

        $this->token = $this->getToken();
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

    public function storeGames(): array
    {
        $gamesArray = [];

        $apiCall = new apiCaller('https://api.igdb.com/', $_ENV);

        $items = $apiCall->callBearer('v4/games', $this->token, 'fields cover,url,name; search "pokemon"; limit 500;');

        $games = json_decode($items, true);

        foreach($games as $game)
        {
            if(! empty($game['cover']))
            {
//                $game['cover'] = $this->getCoverUrl($apiCall, $game['cover']);
            }

            unset($game['id']);

            $gamesArray[] = $game;
        }

        echo "==================The games has been placed in an array=====================";

//        $values  = implode("', '", $escaped_values);
//        $sql = "INSERT INTO `fbdata`($columns) VALUES ('$values')";

//        $db = new mysqlConnector();
//        $data = $db->query('SELECT * FROM games');
//
//        var_dump($data);
//
//        $db->quitConnection();

        return [];
    }

    private function getCoverUrl(ApiCaller $apiCall, int $cover_id): string
    {
        $image = $apiCall->callBearer('v4/covers', $this->token, "fields url; where id = $cover_id;");

        $image = json_decode($image, true);

        $url = str_replace('t_thumb','t_cover_big', $image[0]['url']);

        return 'https:' . $url;
    }


}