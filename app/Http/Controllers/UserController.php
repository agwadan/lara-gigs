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

  //Function to logout user
  public function logout(Request $request)
  {
    auth()->logout();

    $request->session()->invalidate(); //Invalidate the token
    $request->session()->regenerateToken();

    return redirect('/')->with('message', 'You have been logged out');
  }

  //Function to login
  public function login()
  {
    return view('users.login');
  }

  //Authenticate User
  public function authenticate(Request $request)
  {
    $formFields = $request->validate([
      'email' => ['required', 'email'],
      'password' => 'required'
    ]);

    if (auth()->attempt($formFields)) {
      $request->session()->regenerate();

      return redirect('/')->with('message', 'You are now logged in');
    }

    return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
  }
}
