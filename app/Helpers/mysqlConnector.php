<?php

namespace App\Helpers;

use mysqli;
use Symfony\Component\Dotenv\Dotenv;

class mysqlConnector
{
    private object $conn;

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv('./.env');

        $this->conn = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE'],
            $_ENV['DB_PORT']);
    }

    /**
     * @param string $query
     * @return array
     */
    public function query(string $query): array
    {
        return $this->conn->query($query)->fetch_all();
    }

}