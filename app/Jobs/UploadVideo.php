<?php

namespace App\Jobs;

use File;
use Storage;
use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     
    public $filename;
     
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = storage_path() . '/uploads/' . $this->filename;
        
        if(config('settings.uploadLocation') == 's3'){
            if(Storage::disk('s3')->put($this->filename, fopen($file, 'r+'))) {
                File::delete($file);
            }
        } else {
            if(Storage::disk('server')->put('videos/'.$this->filename, fopen($file, 'r+'))) {
                File::delete($file);
            };
        }
    }
}
