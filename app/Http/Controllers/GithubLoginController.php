<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GithubLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('github')->user();

            $gitUser = User::updateOrCreate([
                'github_id' => $user->id
            ], [
                'name' => $user->name,
                'email' => $user->email,
                'github_token' => $user->token,
                'auth_type' => 'github',
                'password' => Hash::make(Str::random(10))
            ]);

            Auth::login($gitUser);
           
            return response()->json([
                'status' => 'sucess', 
                'message' =>'user logged in sucessfully', 
                'data' => [
                    'name' => $user->name, 
                    'email' => $user->email
                ],
            ]);

        } catch (\Exception $e) {
            //throw $th;
            echo $e->getMessage();
        }
    }
}


