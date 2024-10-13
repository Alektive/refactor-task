<?php

declare(strict_types=1);

namespace App\Module\Shared\Network\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface as SerializerException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseApiController extends Controller
{
    /** @var string */
    protected string $nwkRequestClass = \stdClass::class;

    /**
     * @param Request $request
     * @return Response
     * @throws \Throwable
     */
    public function __invoke(
        Request $request,
    ): Response
    {
        try {
            Log::debug('Start process request', ['request' => $request->all()]);
            $response = $this->processRequest($request);
            Log::debug('End process request', ['response' => ['content' => $response->getContent()]]);

            return $response;

        } catch (ValidationException $validationException) {
            Log::notice('Failed validate request data.', [
                'exception' => $validationException,
            ]);

            return response()->json([
                'message' => $validationException
                    ->validator
                    ->errors()
                    ->first(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (SerializerException $serializerException) {
            Log::error('The Request data could not be converted to a DTO object.', [
                'exception' => $serializerException,
            ]);

            return response()->json([
                'message' => env('APP_DEBUG', false) === true
                    ? $serializerException->getMessage()
                    : 'Failed convert request data',
            ], Response::HTTP_BAD_GATEWAY);
        } catch (\Throwable $exception) {
            Log::critical('Failed process request.', [
                'exception' => $exception,
            ]);

            return response()->json([
                'message' => 'Failed process request.',
            ], Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * @param array $data
     * @return object
     * @throws SerializerException
     */
    protected function deserializeRequestData(
        array $data,
    ): object
    {
        return (new Serializer([new ObjectNormalizer()]))
            ->denormalize($data, $this->nwkRequestClass);
    }

    /**
     * TODO: Redefine me!
     *
     * @param Request $request
     * @return Response
     */
    protected function processRequest(
        Request $request,
    ): Response
    {
        return response()
            ->json($request->all(), Response::HTTP_OK);
    }
}
