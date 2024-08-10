<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiCaller {
    protected $baseUrl;
    protected $headers = [];
    protected $response;

    public function __construct($baseUrl, $headers = [])
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = $headers;
    }

    public function call($method, $endpoint, $data = [], $query = [])
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

        $request = Http::withHeaders($this->headers);

        if (strtolower($method) === 'get') {
            $request = $request->get($url, $query);
        } else {
            $request = $request->{strtolower($method)}($url, $data);
        }

        $this->response = $request;
        return $this->response->json();
    }

    public function getResponse()
    {
        return $this->response;
    }
}