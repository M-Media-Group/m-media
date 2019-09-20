<?php

namespace App\Jobs;

use App\InstagramAccount;
use App\Jobs\ScrapeInstagramAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeInstagramAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        foreach ($accounts as $account) {
            ScrapeInstagramAccount::dispatch($account->username);
        }
    }
}
