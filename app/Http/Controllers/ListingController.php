<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Function to show all listings
    public function index()
    {
        //dd(request()->tag);
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() //---- Sorted by the latest coming first
        ]);
    }

    //Function to show single listings
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing //--------------- Find is the name of the static function in the Listing class
        ]);
    }

    //Function to add Listing
    public function create()
    {
        return view('listings.create');
    }

    //Function to store listing data to DB
    public function store(Request $request)
    {

        //Validation of the data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], /* Rule::(unique('tableName in the DB', 'THe field to check and keep unique')) */
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/');
    }
}
