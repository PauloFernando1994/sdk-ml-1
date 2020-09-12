<?php

use App\Facades\Support;

if (function_exists('support')) {
    function support()
    {
        return new Support();
    }
}
