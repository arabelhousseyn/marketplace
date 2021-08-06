<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function index(LoginRequest $request)
    {
        if($request->validated())
        {
            $user= User::where('email', $request->email)->first();
            
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
            User::where('id',$user->id)->update(['api_token' => $token]);
            $response = [
                'user' => User::find($user->id),
            ];
        
             return response($response, 201);
        }
    }
}
