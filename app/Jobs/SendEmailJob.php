<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\AdminAccountEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data, $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data['email'])->send(new AdminAccountEmail([
            'url' => route('login.view'),
            'email' => $this->data['email'],
            'password' => $this->data['password']
        ]));
    }
}
