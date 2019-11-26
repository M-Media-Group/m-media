<?php

namespace App\Jobs;

use App\Email;
use App\User;
use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $input;
    protected $user;
    protected $save;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($input, $save = true, User $user = null)
    {
        if (isset($input['from'])) {
            $input['email'] = $input['from'];
        }
        $this->input = $input;
        $this->user = $user;
        $this->save = $save;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input = $this->input;

        $domain = 'http://' . substr($input['email'], strpos($input['email'], '@') + 1);
        $website_url = parse_url($domain);

        if ($this->save == false) {
            return [
                'email' => $input['email'],
                'website_id' => null,
                'user_id' => null,
                'is_public' => 0,
                'can_receive_mail' => null,
                'email_verified_at' => null,
                'notes' => $input['notes'] ?? null,
            ];
        }

        $website = Website::firstOrCreate(
            ['host' => $website_url['host']],
            ['scheme' => $website_url['scheme']]
            //['is_scrapeable' => $data->private ? 0 : 1]
        );

        $email = Email::firstOrCreate(
            ['email' => $input['email']],
            [
                'website_id' => $website->id,
                'user_id' => null,
                'is_public' => 0,
                //'can_receive_mail' => 1,
                'email_verified_at' => null,
                'notes' => $input['notes'] ?? null,
            ]
        )->load('defaultForUser', 'user');

        return $email;
    }
}
