<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register($data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login($data)
    {
        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type'    => 'password',
            'client_id'     => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username'      => $data['email'],
            'password'      => $data['password'],
        ]);

        if ($response->failed()) {
            return ['error' => 'Invalid credentials'];
        }

        return $response->json();
    }
}
