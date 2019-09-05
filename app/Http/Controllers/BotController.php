<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Jobs\SyncBots;
use Illuminate\Http\Request;

class BotController extends Controller
{

    public function index(Request $request)
    {
        return Bot::get();
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
        return SyncBots::dispatchNow();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # PhoneLog::create(['phone_id' => $phone->id, 'type' => 'INBOUND']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $PhoneLog = PhoneLog::findOrFail($id);

        $request->validate([
            'notes' => 'nullable',
            'ended_at' => 'nullable',
        ]);

        $PhoneLog->update($request->only('notes', 'ended_at'));
        return $PhoneLog;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
