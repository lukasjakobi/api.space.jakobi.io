<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Managers\LaunchManager;
use App\Http\Response\Response;
use Illuminate\Http\JsonResponse;

class LaunchController extends Controller
{

    /**
     * @var LaunchManager
     */
    private LaunchManager $launchManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->launchManager = new LaunchManager();
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     */
    public function getLaunch(string $uuid): JsonResponse
    {
        $response = new Response();
        $launch = $this->launchManager->getLaunchByUUID($uuid);

        if ($launch === null) {
            return $response->setStatusCode(404)->build();
        }

        return $response->setContent($launch)->build();
    }

    /**
     * @return JsonResponse
     */
    public function getLaunches(): JsonResponse
    {
        $response = new Response();
        $launches = $this->launchManager->getLaunches();

        if ($launches === null) {
            return $response->setStatusCode(500)->build();
        }

        return $response->setContent($launches)->build();
    }
}
