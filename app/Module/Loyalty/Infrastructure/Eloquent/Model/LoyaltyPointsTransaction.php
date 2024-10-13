<?php

namespace App\Module\Loyalty\Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsTransaction extends Model implements \App\Module\Loyalty\Domain\Api\LoyaltyPointsTransaction
{
    protected $table = 'loyalty_points_transaction';

    protected $fillable = [
        'account_id',
        'points_rule',
        'points_amount',
        'description',
        'payment_id',
        'payment_amount',
        'payment_time',
    ];

    /** @var LoyaltyAccount|null */
    private ?LoyaltyAccount $account = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return LoyaltyAccount
     */
    public function getAccount(): LoyaltyAccount
    {
        return $this->account
            ?? $this->account = LoyaltyAccount::where('id', '=', $this->account_id)->firstOrFail();
    }

    /**
     * @return int
     */
    public function getPointsAmount(): int
    {
        return $this->points_amount;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->canceled > 0;
    }

    public static function performPaymentLoyaltyPoints($account_id, $points_rule, $description, $payment_id, $payment_amount, $payment_time)
    {
        $points_amount = 0;

        if ($pointsRule = LoyaltyPointsRule::where('points_rule', '=', $points_rule)->first()) {
            $points_amount = match ($pointsRule->accrual_type) {
                LoyaltyPointsRule::ACCRUAL_TYPE_RELATIVE_RATE => ($payment_amount / 100) * $pointsRule->accrual_value,
                LoyaltyPointsRule::ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT => $pointsRule->accrual_value
            };
        }

        return LoyaltyPointsTransaction::create([
            'account_id' => $account_id,
            'points_rule' => $pointsRule?->id,
            'points_amount' => $points_amount,
            'description' => $description,
            'payment_id' => $payment_id,
            'payment_amount' => $payment_amount,
            'payment_time' => $payment_time,
        ]);
    }

    public static function withdrawLoyaltyPoints($account_id, $points_amount, $description) {
        return LoyaltyPointsTransaction::create([
            'account_id' => $account_id,
            'points_rule' => 'withdraw',
            'points_amount' => -$points_amount,
            'description' => $description,
        ]);
    }
}
