<?php

namespace App\Http\Controllers;

use App\Phone;
use Gate;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $this->authorize('index', Phone::class);

        $phones = Phone::withCount('logs')
            ->when($user, function ($query, $user) {
                return $query->where('user_id', $user);
            })->get();

        $all_users = \App\User::all();
        $users = collect();

        foreach ($all_users as $user) {
            $data = [
                'full_name' => $user->full_name,
                'id' => $user->id,
            ];
            $users->push($data);
        }

        return view('phones.index', compact('phones', 'users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Phone $phone
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Phone $phone)
    {
        $this->authorize('show', $phone);
        $phone->load('logs');

        return view('phones.show', compact('phone'));
    }

    public function call(Phone $phone, Request $request)
    {
        if (Gate::denies('call', $phone)) {
            abort(403, 'Unauthorized action.');
        }
        $client = AWS::createClient('Connect', ['region' => 'eu-central-1']);

        return response()->json([
            'availability' => $client->startOutboundVoiceContact([
                'Attributes' => [
                    'name' => $phone->primaryUser ? $phone->primaryUser->name : $phone->user->name,
                    'message' => '<speak>'.$request->input('message', '').'</speak>',
                    'transfer' => $request->input('transfer', 'false'),
                ],
                //'ClientToken' => '<string>',
                'ContactFlowId' => config('aws.connect.ContactFlowId'), // REQUIRED
                'DestinationPhoneNumber' => $phone->e164, // REQUIRED
                'InstanceId' => config('aws.connect.InstanceId'), // REQUIRED
                'QueueId' => config('aws.connect.QueueId'),
                //'SourcePhoneNumber' => '<string>',
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Phone $phone
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Phone               $phone
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        $this->authorize('update', $phone);
        $request->validate([
            'is_public' => 'nullable|boolean',
            'can_receive_mail' => 'nullable|boolean',
            'user_id' => 'nullable',
        ]);
        $phone->update($request->only('can_receive_mail', 'is_public', 'user_id'));

        return $phone;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Phone $phone
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        //
    }
}
