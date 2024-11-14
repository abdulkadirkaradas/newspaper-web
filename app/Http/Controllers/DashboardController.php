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
        $news = json_encode($decoded['news']);

        $newsCategories = $this->getNewsCategories();

        $data = [
            'news' => $news,
            'newsCategories' => $newsCategories
        ];

        if ($userInformation !== []) {
            $data['userInformation'] = $userInformation;
        }

        return view('layouts.main', $data);
    }

    private function getNewsCategories()
    {
        $this->apiCaller->call(GET, 'public/news-categories', [], []);

        $response = $this->apiCaller->getResponse();

        $decoded = json_decode($response, true);
        return json_encode($decoded['categories']);
    }
}
