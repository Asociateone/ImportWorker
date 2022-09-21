<?php

require_once './vendor/autoload.php';

use App\Workers\Amazon;

$new = new Amazon();

$new->getGames();