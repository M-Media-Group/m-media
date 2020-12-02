<?php

namespace App\Http\Controllers;

use App\AuthenticationEvent;
use Illuminate\Http\Request;

class AuthenticationEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $this->authorize('index', AuthenticationEvent::class);

        $authentication_events = AuthenticationEvent::when($user, function ($query, $user) {
            return $query->where('user_id', $user);
        })->get();

        return view('authenticationEvents.index', compact('authentication_events'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuthenticationEvent  $authenticationEvent
     * @return \Illuminate\Http\Response
     */
    public function show(AuthenticationEvent $authenticationEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuthenticationEvent  $authenticationEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthenticationEvent $authenticationEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuthenticationEvent  $authenticationEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthenticationEvent $authenticationEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuthenticationEvent  $authenticationEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthenticationEvent $authenticationEvent)
    {
        //
    }
}
