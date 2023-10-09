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
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(6) //---- Sorted by the latest coming first
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

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        return redirect('/')->with('message', 'Listing Created successfully');
    }

    /* Show Edit Form */
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing)
    {

        //Validation of the data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);
        return back()->with('message', 'Listing Created successfully');
    }

    /* Delete Listing */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully');
    }
}
