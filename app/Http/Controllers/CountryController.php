<?php

namespace App\Http\Controllers;

use App\Country;
use App\Jobs\SaveCountry;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search_query = $request->input('q');

        $countries = Country::when($search_query, function ($query, $search_query) {
            return $query->where('name', 'like', "%{$search_query}%");
        })
            ->with('cities')
            ->get();

        return $countries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'iso' => 'string',
        ]);

        return SaveCountry::dispatchNow($request->input('iso'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Country $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return $country->load('cities');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Country $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $emailLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Country            $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $emailLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Country $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $emailLog)
    {
        //
    }

}
