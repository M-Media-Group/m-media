<?php

namespace App\Http\Controllers;

use App\Jobs\SavePhone;
use App\Notifications\CallbackRequested;
use App\Phone;
use App\PhoneLog;
use Illuminate\Http\Request;

class PhoneLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', PhoneLog::class);
        // $input = [];
        // $input['phonenumber'] = $number;
        // $input['country'] = ($request->input('country')) ?? null;
        // $input['callType'] = ($request->input('type')) ?? 'INBOUND';
        // $input['callNotes'] = ($request->input('notes')) ?? null;
        // $input['language'] = (isset($request['language']) && $request['language'] != '') ? $request['language'] : 'en';
        // $input['region'] = (isset($request['region']) && $request['region'] != '') ? $request['region'] : null;
        // return SavePhone::dispatchNow($input, false);

        $phone_logs = PhoneLog::get();

        return view('phoneLogs.index', compact('phone_logs'));

        return PhoneLog::get();
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
        $input = [];
        $input['phonenumber'] = $request->input('number');
        $input['country'] = ($request->input('country')) ? $request->input('country') : null;
        $input['callType'] = ($request->input('type')) ? $request->input('type') : 'INBOUND';
        $input['callNotes'] = ($request->input('notes')) ? $request->input('notes') : null;
        $input['language'] = (isset($request['language']) && $request['language'] != '') ? $request['language'] : 'en';
        $input['region'] = (isset($request['region']) && $request['region'] != '') ? $request['region'] : null;
        $phone = SavePhone::dispatchNow($input);
        PhoneLog::create(['phone_id' => $phone->id, 'notes' => $input['callNotes'], 'type' => $input['callType']]);
        $phone->logs = PhoneLog::where('phone_id', $phone->id)->get();

        return $phone;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // PhoneLog::create(['phone_id' => $phone->id, 'type' => 'INBOUND']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $PhoneLog = PhoneLog::with('phone.defaultForUser')->findOrFail($id);

        $request->validate([
            'notes' => 'nullable',
            'ended_at' => 'nullable',
        ]);

        $PhoneLog->update($request->only('notes', 'ended_at'));

        if (isset($PhoneLog->phone->defaultForUser) && $request->input('notes') == 'Customer requested a callback.') {
            $PhoneLog->phone->user->notify(new CallbackRequested($PhoneLog));
        }

        return $PhoneLog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
