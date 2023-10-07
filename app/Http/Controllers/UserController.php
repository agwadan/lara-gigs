<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Function to register a user
    public function register()
    {
        return view('users.register');
    }
}
