<?php

namespace App\Module\Loyalty\Infrastructure\Eloquent\Model;

use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoyaltyAccount extends Model implements \App\Module\Loyalty\Domain\Api\LoyaltyAccount
{
    protected $table = 'loyalty_account';

    protected $fillable = [
        'phone',
        'card',
        'email',
        'email_notification',
        'phone_notification',
        'active',
    ];

    /**
     * @return bool
     */
    public function canNotifyEmail(): bool
    {
        return !empty($this->email) && in_array($this->email_notification, [true, 'true']);
    }

    /**
     * @return bool
     */
    public function canNotifySms(): bool
    {
        return !empty($this->phone) && in_array($this->phone_notification, [true, 'true']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getBalance(): float
    {
        return LoyaltyPointsTransaction::where('canceled', '=', 0)->where('account_id', '=', $this->id)->sum('points_amount');
    }

    public function isActive(): bool
    {
        return in_array($this->active, [true, 'true']);
    }

    public function notify()
    {
        if ($this->email != '' && $this->email_notification) {
            if ($this->active) {
                Mail::to($this)->send(new AccountActivated($this->getBalance()));
            } else {
                Mail::to($this)->send(new AccountDeactivated());
            }
        }

        if ($this->phone != '' && $this->phone_notification) {
            // instead SMS component
            Log::info('Account: phone: ' . $this->phone . ' ' . ($this->active ? 'Activated' : 'Deactivated'));
        }
    }
}
