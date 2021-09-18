<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
uSe App\Mail\SendResetlink;


class SendResetlinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

      public $email ;
      public $data ;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$data = null){
        $this->email = $email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
          $Mail = new SendResetlink($this->data);
          Mail::to($this->email)->send($Mail);
    }
}
