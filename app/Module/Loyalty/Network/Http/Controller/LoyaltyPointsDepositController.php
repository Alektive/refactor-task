<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Controller;

use App\Module\Shared\Network\Controller\BaseApiController;
use App\Module\Loyalty\Domain\Api\LoyaltyPointsAccount;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionDeposit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In as RuleIn;
use Symfony\Component\HttpFoundation\Response;

final class LoyaltyPointsDepositController extends BaseApiController
{
    /** @var string */
    protected string $nwkRequestClass = NwkLoyaltyPointsTransactionDeposit::class;

    /**
     * @param Request $request
     * @return Response
     * @throws \Throwable
     */
    protected function processRequest(
        Request $request,
    ): Response
    {
        // предварительная валидация данных
        // todo: нужно вынести в отдельный `middleware/validator`, пока не понял как это красиво сделать
        $validatedData = $this->validate(
            request: $request,
            rules: [
                'account_id' => ['required', 'integer'],
                'account_type' => ['required', 'string', new RuleIn(LoyaltyPointsAccount::ALLOWED_TYPES)],
                'description' => ['required', 'string', 'min:10', 'max:1000'],
                'payment_id' => ['required', 'integer', 'min:1'],
                'payment_amount' => ['required', 'integer', 'min:1'],
                'payment_time' => ['required', 'integer'],
                'points_amount' => ['required', 'integer', 'min:1'],
            ],
        );

        /** @var NwkLoyaltyPointsTransactionDeposit $nwkLoyaltyPointsTransactionDeposit */
        $nwkLoyaltyPointsTransactionDeposit = $this->deserializeRequestData($validatedData);

        return response()->json($nwkLoyaltyPointsTransactionDeposit);
    }
}
