<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCaller;
use App\Helpers\ApiHeaders;

class DashboardController extends Controller
{
    private ApiCaller $apiCaller;
    private ApiHeaders $apiHeaders;

    public function __construct(ApiHeaders $apiHeaders)
    {
        $this->apiHeaders = $apiHeaders;

        $this->apiCaller = new ApiCaller(
            $this->apiHeaders->getApiUrl(),
            $this->apiHeaders->getHeaders()
        );
    }

    public function dashboard()
    {
        //TODO: https://github.com/abdulkadirkaradas/newspaper-web/issues/3
        //TODO: https://github.com/abdulkadirkaradas/newspaper-web/issues/4

        // Added for testing purposes
        // session()->forget('auth_token');

        $endpoint = session()->exists('auth_token')
            ? 'writer/news/logged-user-news/'
            : 'public/news/';

        $query = session()->exists('auth_token')
            ? []
            : ["type" => "all"];

        $userInformation = session()->exists('auth_token')
            ? getUserInformation()
            : [];

        $this->apiCaller->call(GET, $endpoint, [], $query);

        $response = $this->apiCaller->getResponse();
        $decoded = json_decode($response, true);

        if (isset($decoded['status']) && $decoded['status'] !== 400) {
            $decoded = [];
        }

        $news = json_encode($decoded['news']);

        $newsCategories = $this->getNewsCategories();

        $data = [
            'appName' => strtoupper(env('APP_NAME')),
            'news' => $news,
            'newsCategories' => $newsCategories,
        ];

        if ($userInformation !== 400) {
            $data['userInformation'] = $userInformation;
        }

        return view('layouts.main', ['mainData' => $data]);
    }

    private function getNewsCategories()
    {
        $this->apiCaller->call(GET, 'public/news-categories', [], []);

        $response = $this->apiCaller->getResponse();

        $decoded = json_decode($response, true);
        return json_encode($decoded['categories']);
    }
}
