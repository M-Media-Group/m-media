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
        $this->middleware('verified')->except(['applyForReporter']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', User::class);
        $users = User::with('primaryPhone')->withCount('bots')->get();

        return view('users.index', compact('users'));
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
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('show', $user);
        $user->load('primaryPhone', 'instagramAccounts', 'websites', 'files', 'emails', 'primaryEmail');

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', urldecode($id))->with('primaryPhone.logs', 'phones.country')->firstOrFail();
        $this->authorize('update', $user);

        $roles = Role::get();

        //return $user;
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function myBots(Request $request)
    {
        $user = $request->user()->load('bots');
        $this->authorize('update', $user);

        //return $user;
        return view('users.myBots', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function invoices($id)
    {
        $user = User::where('id', urldecode($id))->firstOrFail();
        $this->authorize('show', $user);

        $pmethod = [];
        $invoices = collect();
        $subscriptions = collect();
        $discounts = collect();
        if ($user->stripe_id) {
            $pmethod = $user->paymentMethods();
            $stripe_customer = $user->asStripeCustomer();
            $subscriptions = $stripe_customer->subscriptions;
            $discounts = $stripe_customer->discount;
            // Cancel invoice code example
            //             $subscriptions = $user->asStripeCustomer()->subscriptions->retrieve('sub_DrywzCY3ajr2uu')->cancel();

            $invoices = $user->invoices();
        }
//        return $subscriptions;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        //$plans = \Stripe\Plan::all(['expand' => ['data.product']]);
        $plans = \Stripe\Subscription::all();
        //$plans2 = $user->asStripeCustomer();

        //return $discounts;
        $intent = $user->createSetupIntent();

        return view('users.invoices', compact('user', 'invoices', 'subscriptions', 'pmethod', 'discounts', 'intent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $validatedData = $request->validate([
            'name'    => ['sometimes', 'required', 'string', 'max:255'],
            'surname' => ['sometimes', 'required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        //invalidate email if is new and require re-confirmation
        if ($user->email != $validatedData['email']) {
            $user->email_verified_at = null;
            $user->save();
        }

        $user->update($validatedData);

        if ($request->user()->can('manage user roles')) {
            $roles = $request->input('roles');
            if (isset($roles)) {
                $user->roles()->sync($roles);
            } else {
                $user->roles()->detach();
            }
        }

        return redirect('/users/'.urlencode($request->user()->id).'/edit');
    }

    public function updateCard(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $stripeToken = $request->input('card_token');
        $user->updateDefaultPaymentMethod($stripeToken);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
