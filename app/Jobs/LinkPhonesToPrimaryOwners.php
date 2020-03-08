<?php

namespace App\Jobs;

use App\Phone;
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
                if (! $user->phones->contains('id', $user->phone_id)) {
                    Phone::where('id', $user->phone_id)->update(['user_id' => $user->id]);
                }
            }

            return $users;
        } catch (Exception $e) {
            return $e;
        }
    }
}
