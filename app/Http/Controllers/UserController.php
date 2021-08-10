<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{

    public function update(UserRequest $request)
    {
        if(Auth::user())
        {
            $user = Auth::user()->update((array) $request->all());
            return response()->json(['message' => 'updated'], 204); 
        }
        return response()->json(['message' => 'you sould to be authenticated as user to handle the request'], 401);
    }
}
