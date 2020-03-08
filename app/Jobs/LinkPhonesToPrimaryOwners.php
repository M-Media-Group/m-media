<?php

namespace App\Jobs;

use App\Jobs\SavePhone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LinkPhonesToPrimaryOwners implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //dd("true");
        try {
            $users = \App\User::with('phones', 'primaryPhone')->get();
            foreach ($users as $user) {
                //dd();
                if (! $user->phones->contains('id', $user->phone_id)) {
                    $phone = SavePhone::dispatch(['phonenumber' => $user->primaryPhone->e164], true, $user);
                    if ($phone['user_id'] !== $user->id) {
                        $phone->update(['user_id' => $user->id]);
                    }
                }
            }

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
