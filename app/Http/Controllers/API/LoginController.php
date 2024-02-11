<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic.once');
    }

    public function login()
    {
        $accessToken = Auth::user()->createToken('Access Token')->accessToken;
        return Response([
            'user' => new UserResource(Auth::user()),
            'accessToken' => $accessToken
        ]);
    }
}
