<?php

namespace App\Workers;

use App\Helpers\apiCaller;

Class Amazon {

    public function apiCall()
    {
        $test = new apiCaller('url', 'test');

        $test->call();
    }
}