<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data){
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $token = bin2hex(random_bytes(30)); // 60 символов
        $user->api_token = $token;
        $user->save();

        return $token;
    }
    public function login(array $data){
        $user = User::where('email', $data['email'])->first();

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        $password = Hash::check($data['password'], $user->password);
        if(!$password){
            return response()->json(['message' => 'Wrong password'], 401);
        }

        return $user->api_token;
    }
    public function getUserByToken(string $token){
        $user = User::where('api_token', $token)->first();

        return $user;
    }
}
