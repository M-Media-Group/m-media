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
        $this->middleware('verified');
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
        $user->load('websites')
            ->loadCount('files', 'emails', 'instagramAccounts', 'bots', 'phones', 'websites', 'adAccounts');

        return view('users.show', ['user' => $user]);
    }

    public function showSelf(Request $request)
    {
        return $request->user();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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
        $sepa_sources = collect();
        if ($user->stripe_id) {
            $sepa_sources = \Stripe\PaymentMethod::all([
                'customer' => $user->stripe_id,
                'type' => 'sepa_debit',
            ])->data;
            $pmethod = $user->paymentMethods();
            $stripe_customer = $user->asStripeCustomer();
            $subscriptions = $stripe_customer->subscriptions;
            $discounts = $stripe_customer->discount;
            // Cancel invoice code example
            //             $subscriptions = $user->asStripeCustomer()->subscriptions->retrieve('sub_DrywzCY3ajr2uu')->cancel();

            $invoices = $user->invoicesIncludingPending();
        }

        $intent = $user->createSetupIntent();
        //return $pmethod;

        return view('users.invoices', compact('user', 'invoices', 'subscriptions', 'pmethod', 'discounts', 'intent', 'sepa_sources'));
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'surname' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
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

        return redirect('/users/' . urlencode($request->user()->id) . '/edit');
    }

    public function notifications(User $user, Request $request)
    {
        if ($request->user()->cant('show', $user)) {
            abort(403, 'Unauthorized action.');
        }

        $notifications = $user->notifications;
        //$user->unreadNotifications->markAsRead();

        return $notifications;
    }

    public function updateCard(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $stripeToken = $request->input('card_token');
        $paymentMethod = $user->updateDefaultPaymentMethod($stripeToken);
        if ($paymentMethod->type == 'sepa_debit') {
            $user->update(['card_last_four' => $paymentMethod->sepa_debit->last4, 'card_brand' => 'Bank account']);
        }

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
