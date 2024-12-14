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

        $publicNews = $this->getNews('public/news/', [], ["type" => "all"]);

        $userInformation = [];
        if (session()->exists('auth_token')) {
            $userInformation = session()->exists('auth_token')
                ? getUserInformation()
                : [];
        }

        $newsCategories = $this->getNewsCategories();

        $data = [
            'appName' => strtoupper(env('APP_NAME')),
            'news' => json_encode($publicNews),
            'newsCategories' => $newsCategories,
        ];

        if ($userInformation !== 400) {
            $data['userInformation'] = $userInformation;
        }

        return view('layouts.main', ['mainData' => $data]);
    }

    private function getNews($endpoint, $data = [], $query = [])
    {
        $this->apiCaller->call(GET, $endpoint, $data, $query);

        $response = $this->apiCaller->getResponse();
        $decoded = json_decode($response, true);

        if (isset($decoded['status']) && $decoded['status'] !== 400) {
            $decoded = [];
        }

        return $decoded['news'];
    }

    private function getNewsCategories()
    {
        $this->apiCaller->call(GET, 'public/news-categories', [], []);

        $response = $this->apiCaller->getResponse();

        $decoded = json_decode($response, true);
        return json_encode($decoded['categories']);
    }
}
