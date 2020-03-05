<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class PaymentFailed
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
