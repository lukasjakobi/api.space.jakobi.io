<?php

declare(strict_types=1);

namespace App\Supplier\Supplier;

use App\Models\Launch;
use App\Models\Rocket;
use App\Supplier\Supplier;

class LaunchLibrary extends Supplier
{

    private const NAME = "LaunchLibrary";
    private const CODE = "ll2";
    private const BASE_URL = "https://ll.thespacedevs.com/2.0.0";

    public function __construct()
    {
        parent::__construct(self::NAME, self::CODE, self::BASE_URL);
    }

    public function requestLaunches(): void
    {

    }

    public function createLaunchFromSupplierResponse($response): Launch
    {

    }

    public function createRocketFromSupplierResponse($response): Rocket
    {

    }
}
