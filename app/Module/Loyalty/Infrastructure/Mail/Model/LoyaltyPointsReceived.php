<?php

namespace App\Module\Loyalty\Infrastructure\Mail\Model;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoyaltyPointsReceived extends Mailable
{
    use Queueable, SerializesModels;

    private $balance;
    private $pointsAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pointsAmount, $balance)
    {
        $this->balance = $balance;
        $this->pointsAmount = $pointsAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.loyaltyPointsReceived')->with([
            'balance' => $this->balance,
            'points' => $this->pointsAmount,
        ]);
    }
}
