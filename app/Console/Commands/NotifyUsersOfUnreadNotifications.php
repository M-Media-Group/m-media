<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyUsersOfUnreadNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notify-users-of-unread-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users of notifications they are missing';

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
        {

            $users = User::whereBetween('seen_at', [Carbon::now()->subDays(90)->toDateString(), Carbon::now()->subHours(24)->toDateString()])
                ->whereHas('unreadNotifications')
                ->withCount('unreadNotifications')
                ->get();

            foreach ($users as $user) {
                $user->notify(new \App\Notifications\CustomNotification([
                    'send_email' => 1,
                    'action' => '/notifications',
                    'action_text' => 'Go to your notifications',
                    'title' => 'You have ' . $user->unread_notifications_count . ' unread ' . str_plural('notification', $user->unread_notifications_count) . '.',
                    'message' => "While you were away, new notifications about your business and account were shared with you. Check out what they are to make sure you don't miss anything important.",
                ]));
            }

            $this->info('Sent emails: ' . count($users));
        }
    }
}
