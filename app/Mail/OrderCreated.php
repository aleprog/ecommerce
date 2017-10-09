<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->products = $order->shopping_cart->productos()->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("developer.zarate@gmail.com")
                    ->view('mailers.order');
    }
}
