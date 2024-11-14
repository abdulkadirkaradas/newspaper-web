<?php

namespace App\Helpers;

class ApiHeaders {
    private string $API_URL = "http://newspaperapi.test/api/v1/";
    private array $headers = [
        "Content-Type" => "application/json",
    ];

    public function setApiUrl(?string $apiUrl = null): void {
        $this->API_URL = $apiUrl ?? $this->API_URL;
    }

    public function getApiUrl(): string {
        return $this->API_URL;
    }

    public function setHeaders(?array $headers = null): void {
        if ($headers === null) {
            throw new \InvalidArgumentException("Headers cannot be null.");
        }
        $this->headers = array_merge($this->headers, $headers);
    }

    public function getHeaders(): array {
        $this->setBearerToken();

        return $this->headers;
    }

    private function setBearerToken(): void {
        if (session()->exists('auth_token')) {
            $this->headers['Authorization'] = "Bearer " . session('auth_token');
        }
    }
}
