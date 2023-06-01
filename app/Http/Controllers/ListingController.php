<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Function to show all listings
    public function index()
    {
        //dd(request()->tag);
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag']))->get() //---- Sorted by the latest coming first
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
