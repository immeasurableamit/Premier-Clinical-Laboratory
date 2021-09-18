<?php

namespace App\Jobs;

use App\Mail\AdminAccountEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmployeeLoginJob implements ShouldQueue
{
    protected $data;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
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
            'url' => route('emp.login.view'),
            'email' => $this->data['email'],
            'password' => $this->data['random_password']
        ]));

        if (Mail::failures()) {
            return false;
        }
    }
}
