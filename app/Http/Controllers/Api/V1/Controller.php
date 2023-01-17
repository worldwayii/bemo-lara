<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller as HttpController;


class Controller extends HttpController
{
    public function __construct()
    {
        // auth()->setDefaultDriver('api');
    }
}
