<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendEmailConfirm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $email;
    private $id;
    private $request;
    private $items;
    private $totalPrice;
    private $totalQty;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $id, $request, $items, $totalQty, $totalPrice)
    {
        $this->email = $email;
        $this->id = $id;
        $this->request = $request->all();
        $this->items = $items;
        $this->totalPrice = $totalPrice;
        $this->totalQty = $totalQty;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(
            'emails.confirmorder',
            [
                'request' => $this->request,
                'id' => $this->id,
                'carts' => $this->items,
                'totalQty' => $this->totalQty,
                'totalPrice' => $this->totalPrice
            ],
            function ($email) {
                $email->subject('Xác nhận đơn hàng');
                $email->to($this->email);
            }
        );
    }
}
