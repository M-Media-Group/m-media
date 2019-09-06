<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified')->except(['index', 'show', 'applyForReporter']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::get();
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $invoices = $user->invoices();
        return view('users.show', ['user' => $user, 'invoices' => $invoices]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', urldecode($id))->with('primaryPhone.logs', 'phones.country', 'bots')->firstOrFail();
        $this->authorize('update', $user);

        $pmethod = [];
        $subscriptions = [];
        if ($user->stripe_id) {
            $pmethod = $user->paymentMethods();
            $subscriptions = $user->asStripeCustomer()->subscriptions;
        }
        $roles = Role::get();

        #return $user;
        return view('users.edit', compact('user', 'roles', 'pmethod', 'subscriptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function invoices($id)
    {
        $user = User::where('id', urldecode($id))->firstOrFail();
        $this->authorize('update', $user);

        $invoices = [];
        if ($user->stripe_id) {
            $invoices = $user->invoices();
        }

        #return $user;
        return view('users.invoices', compact('user', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $validatedData = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'surname' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);
        $user->update($validatedData);

        if ($request->user()->can('manage user roles')) {
            $roles = $request->input('roles');
            if (isset($roles)) {
                $user->roles()->sync($roles);
            } else {
                $user->roles()->detach();
            }
        }

        return redirect('/users/' . urlencode($request->user()->id) . '/edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function applyForReporter(Request $request)
    {

        $user = $request->user();

        $this->authorize('update', $user);

        $user->assignRole('reporter');

        $user->revokePermissionTo('apply to report');

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
