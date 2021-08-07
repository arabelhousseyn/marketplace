<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
class LoginController extends Controller
{
    function index(LoginRequest $request)
    {
        if($request->validated())
        {
            
            if(Auth::attempt($request->all()))
            {
            $token = $request->user()->createToken('my-app-token');
            User::where('id',$request->user()->id)->update(['api_token' => $token->plainTextToken]);
            $response = [
                'token' => $token->plainTextToken,
            ];
        
             return response($response, 201);
            }
            
            return response()->json(['message' => 'These credentials do not match our records.'], 500);

        }
    }
}
