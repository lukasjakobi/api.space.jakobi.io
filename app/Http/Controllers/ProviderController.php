<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Managers\Defaults;
use App\Http\Managers\ProviderManager;
use App\Http\Managers\RocketManager;
use App\Http\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProviderController extends Controller
{

    /**
     * @var ProviderManager
     */
    private ProviderManager $providerManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->providerManager = new ProviderManager();
    }

    /**
     * @param string $provider
     * @return JsonResponse
     */
    public function getProvider(string $provider): JsonResponse
    {
        $response = new Response();

        $result = $this->providerManager->getProviderBySlug($provider);

        if ($result === null) {
            return $response->setStatusCode(404)->build();
        }

        return $response->setResult($result)->build();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProviders(Request $request): JsonResponse
    {
        $response = new Response();

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;

        $providers = $this->providerManager->getProviders(
            Defaults::DATABASE_COLUMN_CREATED,
            Defaults::DATABASE_ORDER_DESC,
            $limit,
            $page
        );

        if ($providers === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setTotal($this->providerManager->getTotalAmount())->setResult($providers)->build();
    }
}
