<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Managers\Defaults;
use App\Http\Managers\LaunchManager;
use App\Http\Managers\PadManager;
use App\Http\Managers\ProviderManager;
use App\Http\Managers\RocketManager;
use App\Http\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LaunchController extends Controller
{

    /**
     * @var LaunchManager
     */
    private LaunchManager $launchManager;

    /**
     * @var RocketManager
     */
    private RocketManager $rocketManager;

    /**
     * @var ProviderManager
     */
    private ProviderManager $providerManager;

    /**
     * @var PadManager
     */
    private PadManager $padManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->launchManager = new LaunchManager();
        $this->rocketManager = new RocketManager();
        $this->providerManager = new ProviderManager();
        $this->padManager = new PadManager();
    }

    /**
     * @param string $launch
     * @return JsonResponse
     */
    public function getLaunch(string $launch): JsonResponse
    {
        $response = new Response();

        $result = $this->launchManager->getLaunchBySlug($launch);

        if ($result === null) {
            return $response->setStatusCode(404)->build();
        }

        return $response->setContent($result)->build();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPreviousLaunches(Request $request): JsonResponse
    {
        $response = new Response();

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;
        $detailed = $request->has("detailed") ? (bool) $request->get("detailed") : Defaults::REQUEST_DETAILED;

        if (!is_bool($detailed)) {
            $detailed = Defaults::REQUEST_DETAILED;
        }

        $launches = $this->launchManager->getLaunches(
            false,
            Defaults::DATABASE_COLUMN_START_NET,
            Defaults::DATABASE_ORDER_DESC,
            $limit,
            $page,
            $detailed
        );

        if ($launches === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setContent($launches)->build();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUpcomingLaunches(Request $request): JsonResponse
    {
        $response = new Response();

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;
        $detailed = $request->has("detailed") ? (bool) $request->get("detailed") : Defaults::REQUEST_DETAILED;

        if (!is_bool($detailed)) {
            $detailed = Defaults::REQUEST_DETAILED;
        }

        $launches = $this->launchManager->getLaunches(
            true,
            Defaults::DATABASE_COLUMN_START_NET,
            Defaults::DATABASE_ORDER_ASC,
            $limit,
            $page,
            $detailed
        );

        if ($launches === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setContent($launches)->build();
    }

    /**
     * @param $provider
     * @param Request $request
     * @return JsonResponse
     */
    public function getLaunchesByProvider($provider, Request $request): JsonResponse
    {
        $response = new Response();

        // provider
        $provider = $this->providerManager->getProviderBySlug($provider);

        if ($provider === null) {
            return $response->setStatusCode(404)->build();
        }

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;
        $detailed = $request->has("detailed") ? (bool) $request->get("detailed") : Defaults::REQUEST_DETAILED;

        if (!is_bool($detailed)) {
            $detailed = Defaults::REQUEST_DETAILED;
        }

        $launches = $this->launchManager->getLaunchesByProvider(
            $provider,
            $limit,
            $page,
            $detailed
        );

        if ($launches === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setContent($launches)->build();
    }

    /**
     * @param $rocket
     * @param Request $request
     * @return JsonResponse
     */
    public function getLaunchesByRocket($rocket, Request $request): JsonResponse
    {
        $response = new Response();

        // rocket
        $rocket = $this->rocketManager->getRocketBySlug($rocket);

        if ($rocket === null) {
            return $response->setStatusCode(404)->build();
        }

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;
        $detailed = $request->has("detailed") ? (bool) $request->get("detailed") : Defaults::REQUEST_DETAILED;

        if (!is_bool($detailed)) {
            $detailed = Defaults::REQUEST_DETAILED;
        }

        $launches = $this->launchManager->getLaunchesByRocket(
            $rocket,
            $limit,
            $page,
            $detailed
        );

        if ($launches === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setContent($launches)->build();
    }

    /**
     * @param $pad
     * @param Request $request
     * @return JsonResponse
     */
    public function getLaunchesByPad($pad, Request $request): JsonResponse
    {
        $response = new Response();

        // pad
        $pad = $this->padManager->getPadBySlug($pad);

        if ($pad === null) {
            return $response->setStatusCode(404)->build();
        }

        // parameters
        $limit = $request->has("limit") ? (int) $request->get("limit") : Defaults::REQUEST_LIMIT;
        $page = $request->has("page") ? (int) $request->get("page") : Defaults::REQUEST_PAGE;
        $detailed = $request->has("detailed") ? (bool) $request->get("detailed") : Defaults::REQUEST_DETAILED;

        if (!is_bool($detailed)) {
            $detailed = Defaults::REQUEST_DETAILED;
        }

        $launches = $this->launchManager->getLaunchesByPad(
            $pad,
            $limit,
            $page,
            $detailed
        );

        if ($launches === null) {
            return $response->setStatusCode(204)->build();
        }

        return $response->setContent($launches)->build();
    }
}
