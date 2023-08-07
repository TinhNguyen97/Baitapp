<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailCoverPass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $email;
    private $userId;
    private $fullName;
    private $token;
    private $appUrl;
    private $httpHost;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $userId, $fullName, $token, $appUrl, $httpHost)
    {
        $this->email = $email;
        $this->userId = $userId;
        $this->fullName = $fullName;
        $this->token = $token;
        $this->appUrl = $appUrl;
        $this->httpHost = $httpHost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(
            'emails.checkforgetpass',
            [
                'user_id' => $this->userId,
                'full_name' => $this->fullName,
                'token' => $this->token,
                'app_url' => $this->appUrl,
                'http_host' => $this->httpHost
            ],
            function ($email) {
                $email->subject('Lấy lại mật khẩu');
                $email->to($this->email);
            }
        );
    }
}
