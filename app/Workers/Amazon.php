<?php

namespace App\Workers;

use App\Helpers\apiCaller;

Class Amazon {

    public function apiCall()
    {
        $test = new apiCaller('https://id.twitch.tv/', 'test');

        $test->call('oauth2');
    }
}