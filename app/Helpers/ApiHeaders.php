<?php

namespace App\Helpers;

class ApiHeaders {
    private static string $API_URL = "http://newspaperapi.test/api/v1/";
    private static array $headers = [
        "Content-Type" => "application/json",
    ];

    public static function setApiUrl(string $apiUrl = null): void {
        self::$API_URL = $apiUrl ?? self::$API_URL;
    }

    public static function getApiUrl(): string {
        return self::$API_URL;
    }

    public static function setHeaders(array $headers = null): void {
        self::$headers = $headers ? array_merge(self::$headers, $headers) : self::$headers;
    }

    public static function getHeaders(): array {
        return self::$headers;
    }

    public static function setBearerToken(string $headerName = 'Authorization', string $bearerToken = null): void {
        if ($bearerToken !== null) {
            self::$headers[$headerName] = "Bearer $bearerToken";
        }
    }
}
