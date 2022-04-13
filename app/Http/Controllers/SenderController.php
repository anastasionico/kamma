<?php

namespace App\Http\Controllers;

use App\Http\Requests\SenderRequest;
use App\Http\Services\SenderService;
use Exception;
use Illuminate\Http\JsonResponse;

class SenderController extends Controller
{
    public $service;

    /**
     * SenderController constructor.
     * @param SenderService $service
     */
    public function __construct(SenderService $service)
    {
        $this->service = $service;
    }

    /**
     * @param SenderRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __invoke(SenderRequest $request): JsonResponse
    {
        $validated = collect($request->validated());

        try {
            $response = $this->service->handle($validated);
        } catch (Exception $exception) {
            $exception->getMessage();
        }

        return response()->json([
            'message' => 'Friend saved and Email sent',
            'success' => $response,
        ]);
    }
}
