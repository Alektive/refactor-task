<?php

declare(strict_types=1);

namespace App\Module\Loyalty\Network\Http\Controller;

use App\Module\Shared\Network\Controller\BaseApiController;
use App\Module\Loyalty\Network\Http\Api\NwkLoyaltyPointsTransactionCancel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class LoyaltyPointsCancelController extends BaseApiController
{
    /** @var string */
    protected string $nwkRequestClass = NwkLoyaltyPointsTransactionCancel::class;

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

        return response()->json($nwkLoyaltyPointsTransactionCancel);
    }
}
