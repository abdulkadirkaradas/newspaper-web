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

    public function dashboard()
    {
        $this->apiCaller->call(GET, 'public/allNews/', [], []);

        $response = $this->apiCaller->getResponse();

        return view('layouts.main', ['response' => $response]);
    }
}
