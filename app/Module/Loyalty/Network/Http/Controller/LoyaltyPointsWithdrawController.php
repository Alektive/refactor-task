<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Controller;

use App\Module\Loyalty\Domain\Api\LoyaltyAccountFinder;
use App\Module\Loyalty\Domain\Api\WithdrawLoyaltyPointsAccount;
use App\Module\Loyalty\Network\Http\Mapper\RawWithdrawLoyaltyPointsMapper;
use App\Module\Loyalty\UseCase\Api\DepositLoyaltyPointsAccount;
use App\Module\Shared\Network\Controller\BaseApiController;
use App\Module\Loyalty\Domain\Api\LoyaltyAccount;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionWithdraw;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In as RuleIn;
use Symfony\Component\HttpFoundation\Response;

class LoyaltyPointsWithdrawController extends BaseApiController
{
    /** @var string */
    protected string $nwkRequestClass = NwkLoyaltyPointsTransactionWithdraw::class;

    /**
     * @param LoyaltyAccountFinder $loyaltyAccountFinder
     * @param WithdrawLoyaltyPointsAccount $withdrawLoyaltyPointsAccount
     */
    public function __construct(
        private LoyaltyAccountFinder $loyaltyAccountFinder,
        private WithdrawLoyaltyPointsAccount $withdrawLoyaltyPointsAccount,
    )
    {
    }

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
                'account_type' => ['required', 'string', new RuleIn(LoyaltyAccount::ALLOWED_TYPES)],
                'description' => ['required', 'string', 'min:10', 'max:1000'],
                'points_amount' => ['required', 'integer', 'min:1'],
            ],
        );

        /** @var NwkLoyaltyPointsTransactionWithdraw $nwkLoyaltyPointsTransactionWithdraw */
        $nwkLoyaltyPointsTransactionWithdraw = $this->deserializeRequestData($validatedData);

        // find & check account
        // todo: если требуется повышеный уровень безопасности доступа к аккаунту, то лучше эти проверки убрать
        $loyaltyAccount = $this
            ->loyaltyAccountFinder
            ->getById($nwkLoyaltyPointsTransactionWithdraw->account_id);
        if (!$loyaltyAccount) {
            return response()->json(
                ['message' => sprintf('Account #%s not found.', $nwkLoyaltyPointsTransactionWithdraw->account_id)],
                Response::HTTP_BAD_REQUEST,
            );
        }
        if (!$loyaltyAccount->isActive()) {
            return response()->json(
                ['message' => sprintf('Account #%s in not active.', $nwkLoyaltyPointsTransactionWithdraw->account_id)],
                Response::HTTP_BAD_REQUEST,
            );
        }

        // execute via use case
        $transaction = $this
            ->withdrawLoyaltyPointsAccount
            ->do(
                loyaltyAccount: $loyaltyAccount,
                rawWithdrawLoyaltyPoints: (new RawWithdrawLoyaltyPointsMapper())
                    ->fromNwkLoyaltyPointsTransactionWithdraw($nwkLoyaltyPointsTransactionWithdraw)
            );

        return response()->json(
            ['message' => sprintf('Loyalty account #%s has been successfully replenished', $nwkLoyaltyPointsTransactionWithdraw->account_id)],
            Response::HTTP_OK,
        );
    }
}
