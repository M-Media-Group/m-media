<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class PaymentActionRequired
{
    use SerializesModels;

    public $invoice;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

}
