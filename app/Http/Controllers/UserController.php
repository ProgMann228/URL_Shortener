<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $user_service){
        $this->service = $user_service;
    }
    public function register(UserRegisterRequest $request){
        $data = $request->validated();
        $user = $this->service->register($data);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ]);
    }
    public function login(UserLoginRequest $request){
        $data = $request->validated();
        $token = $this->service->login($data);

        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token
        ]);
    }
}
