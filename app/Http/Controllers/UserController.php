<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Function to register a user
    public function register()
    {
        return view('users.register');
    }

    //Function to Store user in db
    public function store(Request $request)
    {
        $formFields = $request->validate(([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6' /* Will automatically check the password_confirmation field */
        ]));

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }
}
