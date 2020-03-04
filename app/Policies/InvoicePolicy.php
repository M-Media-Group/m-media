<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Stripe\Invoice;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasAnyRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     *
     * @return mixed
     */
    public function index(User $user, User $requested_user = null)
    {
        if (! $requested_user) {
            return false;
        }

        return $user->id === $requested_user->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Invoice $invoice
     * @param \App\Invoice $user
     *
     * @return mixed
     */
    public function view(User $user, Invoice $invoice)
    {
        return $invoice->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Invoice $invoice
     *
     * @return mixed
     */
    public function create($invoice)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Invoice $invoice
     * @param \App\Invoice $user
     *
     * @return mixed
     */
    public function update(User $user, Invoice $invoice)
    {
        return $invoice->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Invoice $invoice
     * @param \App\Invoice $user
     *
     * @return mixed
     */
    public function delete(User $user, Invoice $invoice)
    {
        return $invoice->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Invoice $invoice
     * @param \App\Invoice $user
     *
     * @return mixed
     */
    public function restore(User $user, Invoice $invoice)
    {
        return $invoice->customer === $user->stripe_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Invoice $invoice
     * @param \App\Invoice $user
     *
     * @return mixed
     */
    public function forceDelete(User $user, Invoice $invoice)
    {
        return false;
    }
}
