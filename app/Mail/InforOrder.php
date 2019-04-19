<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpParser\Node\Scalar\String_;

class InforOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $mail)
    {
        $this->order = $order;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order_mail')->with([
            'order' => $this->order,
            'mail' => $this->mail,
        ])->to($this->mail);
    }
}
