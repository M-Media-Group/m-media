<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use Illuminate\Http\Request;
use Redirect;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->input('user');

        if ($request->input('user')) {
            $user = User::find($user);
        }

        if (Gate::denies('invoices.index', $user)) {
            abort(403);
        }

        $invoices = \Stripe\Invoice::all(['customer' => $user->stripe_id ?? null]);

        return $invoices->data;

    }

    public function show(Request $request, $id)
    {

        $invoice = \Stripe\Invoice::retrieve(['id' => $id]);

        if (Gate::denies('invoices.view', $invoice)) {
            abort(403);
        }

        return $invoice;

    }

    public function showFuture(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $invoice = \Stripe\Invoice::upcoming(["customer" => $user->stripe_id]);

        if (Gate::denies('invoices.view', $invoice)) {
            abort(403);
        }

        return $invoice;

    }

    public function redirectToStripeInvoice(Request $request, $id)
    {

        $invoice = \Stripe\Invoice::retrieve(['id' => $id]);

        if (Gate::denies('invoices.view', $invoice)) {
            abort(403);
        }

        return Redirect::to($invoice->invoice_pdf);

    }
}
