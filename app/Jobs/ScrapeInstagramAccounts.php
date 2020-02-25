<?php

namespace App\Jobs;

use App\InstagramAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeInstagramAccounts implements ShouldQueue
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
        $accounts = InstagramAccount::where('is_scrapeable', 1)->get();
        $iteration = 0;
        foreach ($accounts as $account) {
            $iteration++;
            ScrapeInstagramAccount::dispatch($account->username)->delay(now()->addSeconds(3 * $iteration));
        }
    }
}
