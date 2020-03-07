<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = $request->input('user');

        $this->authorize('index', Email::class);

        $emails = Email::withCount('logs', 'received_logs')
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

        return view('emails.index', compact('emails', 'users'));
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
     * @param \App\Email $email
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Email $email)
    {
        $this->authorize('show', $email);
        $email->load('logs', 'received_logs');

        return view('emails.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Email $email
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Email               $email
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $this->authorize('update', $email);
        $request->validate([
            'is_public' => 'nullable|boolean',
            'can_receive_mail' => 'nullable|boolean',
            'user_id' => 'nullable',
        ]);
        $email->update($request->only('can_receive_mail', 'is_public', 'user_id'));

        return $email;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Email $email
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
