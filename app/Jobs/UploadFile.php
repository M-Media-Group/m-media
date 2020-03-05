<?php

namespace App\Jobs;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class UploadFile implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    public $timeout = 120;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = Storage::putFile('files/'.($this->request->user()->id ?? 'default'), $this->request->file, $this->request->input('public') ? 'public' : 'private');
        $this->request->merge([
            'name' => $this->request->input('title') ?? $this->request->file->getClientOriginalName() ?? null,
            'url' => $path,
            'extension' => $this->request->file->getMimeType() == 'image/svg' ? 'svg' : $this->request->file->extension(),
            //'type' => $this->request->file->type(),
            'mimeType' => $this->request->file->getMimeType() == 'image/svg' ? 'image/svg+xml' : $this->request->file->getMimeType(),
            'size' => $this->request->file->getSize(),
            'user_id' => $this->request->user()->id ?? null,
        ]);
        $file = File::create($this->request->only('name', 'url', 'extension', 'mimeType', 'size', 'user_id'));

        return $file;
    }
}
