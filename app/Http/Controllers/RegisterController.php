<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCaller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private ApiCaller $apiCaller;

    public function __construct()
    {
        $this->apiCaller = new ApiCaller(API_URL, DEFAULT_HEADERS);
    }

    public function view()
    {
        return view('layouts.auth.register.register');
    }

    public function register(Request $request)
    {
        $params = $request->only(['name', 'lastname', 'username', 'email', 'password']);

        $this->apiCaller->call(POST, 'auth/register/', [], [
            "name" => $params['name'],
            "lastname" => $params['lastname'],
            "username" => $params['username'],
            "email" => $params['email'],
            "password" => $params['password'],
        ]);

        $response = $this->apiCaller->getResponse();

        return view('layouts.main', ['response' => $response]);
    }
}
