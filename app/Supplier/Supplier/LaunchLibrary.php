<?php

declare(strict_types=1);

namespace App\Supplier\Supplier;

use App\Http\Managers\LaunchManager;
use App\Http\Managers\PadManager;
use App\Http\Managers\ProviderManager;
use App\Http\Managers\RocketManager;
use App\Http\Managers\Utils;
use App\Models\Launch;
use App\Models\LaunchStatus;
use App\Models\LaunchTime;
use App\Models\Pad;
use App\Models\Provider;
use App\Models\Rocket;
use App\Supplier\Supplier;
use App\Supplier\SupplierRequest;

class LaunchLibrary extends Supplier
{

    private const NAME = "LaunchLibrary";
    private const CODE = "ll2";
    private const BASE_URL = "https://ll.thespacedevs.com/2.1.0/";

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

    public function __construct()
    {
        parent::__construct(self::NAME, self::CODE, self::BASE_URL);
        $this->launchManager = new LaunchManager();
        $this->rocketManager = new RocketManager();
        $this->providerManager = new ProviderManager();
        $this->padManager = new PadManager();
    }

    public function requestUpcomingLaunches(): void
    {
        $request = new SupplierRequest("GET", self::BASE_URL, "launch/upcoming");
        $response = $request->execute();

        if ($response === null) {
            return;
        }

        foreach ($response->results as $item) {
            $launch = $this->createLaunchFromSupplierResponse($item);

            if ($launch === null) {
                continue;
            }

            if ($launch->getId() === null) {

                // create launch object
                $this->launchManager->createLaunch(
                    $launch->getName(),
                    $launch->getDescription(),
                    $launch->getRocket(),
                    $launch->getPad(),
                    $launch->getProvider(),
                    $launch->getStatus(),
                    $launch->getLaunchTime(),
                    $launch->getTags(),
                    $launch->getLivestreamURL()
                );
            } else {

                // update launch object
                $this->launchManager->updateLaunch(
                    $launch->getSlug(),
                    $launch->getDescription(),
                    $launch->getStatus(),
                    $launch->getLaunchTime(),
                    $launch->getTags(),
                    $launch->getLivestreamURL(),
                    $launch->isPublished()
                );
            }
        }
    }

    public function createLaunchFromSupplierResponse($response): ?Launch
    {
        $launch = new Launch();

        if (isset($response->name)) {
            $explode = explode(" | ", $response->name);

            if (isset($explode[1])) {
                $name = $explode[1];
                $slug = Utils::stringToSlug($name);

                // try to get launch by name
                $launchCheck = $this->launchManager->getLaunchBySlug($slug);

                if ($launchCheck !== null) {
                    return $launchCheck;
                }

                $launch->setName($name);
                $launch->setSlug($slug);
            }
        }

        if (isset($response->mission->description)) {
            $launch->setDescription($response->mission->description);
        }

        if (isset($response->status, $response->status->abbrev)) {
            $launchStatus = new LaunchStatus();

            $launchStatus->setDisplayName($response->status->abbrev);
            $launchStatus->setCancelled(false);

            $launch->setStatus($launchStatus);
        }

        if (isset($response->rocket->configuration)) {
            $rocket = new Rocket();

            if (isset($response->rocket->configuration->name)) {
                $rocket->setName($response->rocket->configuration->name);
                $rocket->setSlug(Utils::stringToSlug($response->rocket->configuration->name));

                $rocketCheck = $this->rocketManager->getRocketBySlug(Utils::stringToSlug($response->rocket->configuration->name));

                if ($rocketCheck !== null) {
                    $rocket = $rocketCheck;
                }
            }

            $launch->setRocket($rocket);
        }

        if (isset($response->pad)) {
            $pad = new Pad();

            if (isset($response->pad->name)) {
                $pad->setName($response->pad->name);
                $pad->setSlug(Utils::stringToSlug($response->pad->name));

                $padCheck = $this->padManager->getPadBySlug(Utils::stringToSlug($response->pad->name));

                if ($padCheck !== null) {
                    $pad = $padCheck;
                }
            }

            if (isset($response->pad->wiki_url)) {
                $pad->setWikiURL($response->pad->wiki_url);
            }

            $launch->setPad($pad);
        }

        if (isset($response->launch_service_provider)) {
            $provider = new Provider();

            if (isset($response->launch_service_provider->name)) {
                $provider->setName($response->launch_service_provider->name);
                $provider->setSlug(Utils::stringToSlug($response->launch_service_provider->name));

                $providerCheck = $this->providerManager->getProviderBySlug(Utils::stringToSlug($response->launch_service_provider->name));

                if ($providerCheck !== null) {
                    $provider = $providerCheck;
                }
            }

            $launch->setProvider($provider);
        }

        if (isset(
            $response->net,
            $response->window_end,
            $response->window_start
        )) {
            $launchTime = new LaunchTime();

            $launchTime->setLaunchNet(\DateTime::createFromFormat(DATE_W3C, $response->net));
            $launchTime->setLaunchWinOpen(\DateTime::createFromFormat(DATE_W3C, $response->window_start));
            $launchTime->setLaunchWinClose(\DateTime::createFromFormat(DATE_W3C, $response->window_end));

            $launch->setLaunchTime($launchTime);
        }

        $launch->setPublished(false);

        return $launch;
    }

    public function createRocketFromSupplierResponse($response): ?Rocket
    {

    }
}
