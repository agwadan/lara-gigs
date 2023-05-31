<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);
