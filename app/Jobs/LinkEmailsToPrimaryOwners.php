<?php

namespace App\Jobs;

use App\Jobs\SaveEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LinkEmailsToPrimaryOwners implements ShouldQueue
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
            $users = \App\User::with('emails', 'primaryEmail')->get();
            foreach ($users as $user) {
                //dd();
                if (!$user->primaryEmail) {

                    $email = SaveEmail::dispatch(['email' => $user->email], true, $user);

                } elseif (!$user->emails->contains('email', '=', $user->primaryEmail->email) && $user->email_verified_at) {

                    $email = SaveEmail::dispatch(['email' => $user->primaryEmail->email], true, $user);
                    if ($email['user_id'] !== $user->id) {
                        $email->update(['user_id' => $user->id]);
                    }

                }
            }
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
