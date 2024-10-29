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
        //TODO: https://github.com/abdulkadirkaradas/newspaper-web/issues/3
        $this->apiCaller->call(GET, 'public/news/', [], [
            "type" => "all"
        ]);

        $response = $this->apiCaller->getResponse();
        $decoded = json_decode($response, true);
        $news = json_encode($decoded['news']);

        $newsCategories = $this->getNewsCategories();

        return view('layouts.main', ['news' => $news, 'newsCategories' => $newsCategories]);
    }

    private function getNewsCategories()
    {
        $this->apiCaller->call(GET, 'public/news-categories', [], []);

        $response = $this->apiCaller->getResponse();

        $decoded = json_decode($response, true);
        return json_encode($decoded['categories']);
    }
}
