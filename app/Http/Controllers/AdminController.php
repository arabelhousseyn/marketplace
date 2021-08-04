<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
           return response()->json(Auth::guard('admin')->user(), 200);
        }else{
            return response()->json(['message' => 'not valid'], 200);
        }
    }
}
