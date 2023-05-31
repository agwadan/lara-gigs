<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Function to show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::all()
        ]);
    }

    //Function to show single listings
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing //--------------- Find is the name of the static function in the Listing class
        ]);
    }
}
