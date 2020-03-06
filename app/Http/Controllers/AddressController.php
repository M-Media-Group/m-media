<?php

namespace App\Http\Controllers;

use App\Address;
use App\Jobs\SaveAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Address::class);

        $search_query = $request->input('q');

        $addresses = Address::when($search_query, function ($query, $search_query) {
            return $query->where('address', 'like', "%{$search_query}%");
        })
            ->with('city.country')
            ->get();

        return $addresses;
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
        $this->authorize('create', Address::class);

        $request->validate([
            'address' => 'string',
            'postal_code' => 'string',
            'city_id' => 'string',
            'is_public' => 'string',
            'user_id' => 'string',
            'notes' => 'string',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        return SaveAddress::dispatchNow($request->only('city_name', 'country_id', 'iso', 'address', 'lat', 'lng', 'user_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Address $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        $this->authorize('show', $address);

        return $address->load('city.country');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Address $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $emailLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Address            $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $emailLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Address $emailLog
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $emailLog)
    {
        //
    }
}
