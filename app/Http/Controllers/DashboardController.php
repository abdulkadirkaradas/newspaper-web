<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCaller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private ApiCaller $apiCaller;

    public function __construct()
    {
        $this->apiCaller = new ApiCaller(API_URL, DEFAULT_HEADERS);
    }
}
