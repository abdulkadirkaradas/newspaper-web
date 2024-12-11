<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCaller;
use App\Helpers\ApiHeaders;
use Illuminate\Http\Request;

class LoginController extends Controller
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

    public function view()
    {
        return view('layouts.auth.login.login');
    }

    public function login(Request $request) {
        $params = $request->only(['email', 'password']);

        $this->apiCaller->call(POST, 'auth/login/', [
            "email" => $params['email'],
            "password" => $params['password'],
        ], []);

        $response = $this->apiCaller->getResponse();

        $decoded = json_decode($response, true);
        $status = $decoded['status'];
        $message = $decoded['message'] ?? null;

        if ($status === 200) {
            $authToken = $decoded['authorisation']['token'];

            session(['auth_token' => $authToken]);

            return response()->json(['status' => $status]);
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function logout()
    {
        $this->apiCaller->call(POST, 'auth/logout/', [], []);

        $response = $this->apiCaller->getResponse();
        $decoded = json_decode($response, true);
        $status = $decoded['status'];
        $message = $decoded['message'] ?? null;

        if ($status === 200) {
            session()->forget('auth_token');

            return response()->json(['status' => $status, 'message' => $message]);
        }

        return response()->json(['status' => 400, 'message' => 'Could not be logged out!']);
    }

    public function checkAuthTokenExists() {
        if (session()->exists('auth_token')) {
            return response()->json(['status' => 'valid'], 200);
        }

        return response()->json(['status' => 'invalid'], 401);
    }
}
