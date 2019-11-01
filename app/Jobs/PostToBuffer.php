<?php

namespace App\Jobs;

use App\File;
use App\InstagramAccount;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostToBuffer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $instagramAccount;
    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file, InstagramAccount $instagramAccount)
    {
        $this->file = $file;
        $this->instagramAccount = $instagramAccount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hashtags = null;
        if ($this->instagramAccount->buffer_id && count($this->instagramAccount->bufferSentPosts()['updates']) > 0) {
            $hashtags_array = [];
            preg_match_all('/#(\w+)/', $this->instagramAccount->bufferSentPosts()['updates'][0]['text'], $matches);
            foreach ($matches[1] as $match) {
                if (!in_array($match, $hashtags_array)) {
                    array_push($hashtags_array, '#'.$match);
                }
            }
            $hashtags = implode(' ', $hashtags_array);
        }
        $data = [
            'profile_ids' => [$this->instagramAccount->buffer_id],
            'text'        => $this->file->name.' '.$hashtags,
            'shorten'     => false,
            'media'       => [
                'photo' => $this->file->url,
            ],
        ];

        $client = new Client();

        return $client->request('POST', 'https://api.bufferapp.com/1/updates/create.json?access_token='.config('blog.buffer.access_token'), [
            'form_params' => $data,
        ]);
    }
}
