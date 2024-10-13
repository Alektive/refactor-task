<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Controller;

use App\Module\Loyalty\Domain\Api\LoyaltyPointsTransactionFinder;
use App\Module\Loyalty\UseCase\Api\CancelLoyaltyPointsTransaction;
use App\Module\Shared\Network\Controller\BaseApiController;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionCancel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class LoyaltyPointsCancelController extends BaseApiController
{
    /** @var string */
    protected string $nwkRequestClass = NwkLoyaltyPointsTransactionCancel::class;

    /**
     * Controller constructor.
     *
     * @param LoyaltyPointsTransactionFinder $loyaltyPointsTransactionFinder
     * @param CancelLoyaltyPointsTransaction $cancelLoyaltyPointsTransaction
     */
    public function __construct(
        private LoyaltyPointsTransactionFinder $loyaltyPointsTransactionFinder,
        private CancelLoyaltyPointsTransaction $cancelLoyaltyPointsTransaction,
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
                'cancellation_reason' => ['required', 'string', 'min:10', 'max:1000'],
                'transaction_id' => ['required', 'integer', 'min:1'],
            ],
        );

        /** @var NwkLoyaltyPointsTransactionCancel $nwkLoyaltyPointsTransactionCancel */
        $nwkLoyaltyPointsTransactionCancel = $this->deserializeRequestData($validatedData);

        // find & check transaction
        // todo: если требуется повышеный уровень безопасности доступа к транзакциям, то лучше эти проверки убрать
        $transaction = $this
            ->loyaltyPointsTransactionFinder
            ->getById($nwkLoyaltyPointsTransactionCancel->transaction_id);
        if (!$transaction) {
            return response()->json(
                ['message' => sprintf('Transaction #%s not found.', $nwkLoyaltyPointsTransactionCancel->transaction_id)],
                Response::HTTP_BAD_REQUEST,
            );
        }
        if ($transaction->isCanceled()) {
            return response()->json(
                ['message' => sprintf('Transaction #%s is already canceled.', $nwkLoyaltyPointsTransactionCancel->transaction_id)],
                Response::HTTP_BAD_REQUEST,
            );
        }

        // execute via use case
        $this
            ->cancelLoyaltyPointsTransaction
            ->do($transaction);

        return response()->json(
            ['message' => 'Transaction #%s has been successfully canceled.'],
            Response::HTTP_OK,
        );
    }
}
