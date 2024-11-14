<?php

use App\Helpers\ApiCaller;
use App\Helpers\ApiHeaders;
use Carbon\Carbon;

if (!function_exists('convertUTCDateToLocalDate')) {
    function convertUTCDateToLocalDate($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }
}

if (!function_exists('render_page')) {
    function render_page($view, $data = [])
    {
        if (view()->exists($view)) {
            return view($view, $data)->render();
        }

        return [
            "message" => "Page doesn't exists"
        ];
    }
}

if (!function_exists('getUserInformation')) {
    function getUserInformation()
    {
        $apiHeaders = new ApiHeaders();

        $apiUrl = $apiHeaders->getApiUrl();
        $headers = $apiHeaders->getHeaders();
        $apiCaller = new ApiCaller($apiUrl, $headers);

        $apiCaller->call(GET, 'auth/user-information', [], []);

        $response = $apiCaller->getResponse();
        $decoded = json_decode($response, true);
        return json_encode($decoded['userInformation']);
    }
}