<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* Route::get('/hello', function () {
    return response('<h2>Hello World</h2>', 404)
        ->header('Content-type', 'text/plain')
        ->header('foo', 'bar'); /------------------------ Custom header
});

Route::get('/post/{id}', function ($id) {

    //dd($id);
    //ddd($id);

    return response('Post ' . $id);
})->where('id', '[0-9]+'); /----------------------------- Limit the id to be numbers

Route::get('/search', function (Request $request) {
    //dd($request->name . ' lives in ' . $request->city);
    return ($request->name . ' lives in ' . $request->city);
}); */

/* All Listings */

Route::get('/', [ListingController::class, 'index']);


//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth'); //the auth middleware prevents users who have not logged in from accessing some routes

//Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Show Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');


//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']); //----- should be below all routes that are in begin with "listings". . . to prevent them from being read as dynamic routes

//Show Register/Create user form
Route::get('/register', [Usercontroller::class, 'register'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//LogUser out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show Login form
Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

//User/Login
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
