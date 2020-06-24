<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request){
        $validated_data = $request->validate([
            'first_name' => 'max:255',
            'middle_name' => 'max:255',
            'last_name' => 'max:255',
            'date_of_birth'=>'max:255',
            'gender' => 'max:255',
            'marital_status' => 'max:255',
            'residence',
            'email' => 'email|required|max:255',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($validated_data);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'accessToken' => $accessToken]);
    }

}
