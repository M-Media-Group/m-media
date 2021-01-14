<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyUsersOfNewFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notify-users-of-new-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users of new files since their last visit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $callback = function ($query) {
            $query
                ->whereDate('files.created_at', '>=', Carbon::now()->subHours(24)->toDateString())
                ->whereRaw('files.created_at >= users.seen_at');
        };

        $users = User::whereHas('files', $callback)->withCount(['files' => $callback])->get();

        foreach ($users as $user) {
            $user->notify(new \App\Notifications\CustomNotification([
                'send_email' => 1,
                'action' => '/files?user=' . $user->id,
                'action_text' => 'Go to your files',
                'title' => $user->files_count . ' new ' . str_plural('file', $user->files_count) . ' moved into your file storage today.',
                'message' => "While you were away, new files were shared with you. Be sure to check out what they are and make sure that they are set to either private or public as needed.",
            ]));
        }
        $this->info('Sent emails: ' . count($users));
    }
}
