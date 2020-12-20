<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Launch;
use App\Models\LaunchTime;
use App\Models\Pad;
use App\Models\Provider;
use App\Models\Rocket;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LaunchManager
{

    private const TABLE = "rl_launch";

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
        $this->rocketManager = new RocketManager();
        $this->providerManager = new ProviderManager();
        $this->padManager = new PadManager();
    }

    /**
     * @param string $uuid
     * @return Launch|null
     */
    public function getLaunchByUUID(string $uuid): ?Launch
    {
        $result = DB::table(self::TABLE)
            ->select([
               "uuid", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("uuid", "=", $uuid)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildLaunchFromDatabaseResult($result);
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getLaunches($limit = 25): array
    {
        $launches = [];

        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->limit($limit)
            ->get();

        foreach ($result as $launch)
        {
            $launches[] = $this->buildLaunchFromDatabaseResult($launch);
        }

        return $launches;
    }

    /**
     * @param Provider $provider
     * @return array
     */
    public function getLaunchesByProvider(Provider $provider): array
    {
        $launches = [];

        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("providerId", "=", $provider->getUUID())
            ->get();

        foreach ($result as $launch)
        {
            $launches[] = $this->buildLaunchFromDatabaseResult($launch);
        }

        return $launches;
    }

    /**
     * @param Rocket $rocket
     * @return array
     */
    public function getLaunchesByRocket(Rocket $rocket): array
    {
        $launches = [];

        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("rocketId", "=", $rocket->getUUID())
            ->get();

        foreach ($result as $launch)
        {
            $launches[] = $this->buildLaunchFromDatabaseResult($launch);
        }

        return $launches;
    }

    /**
     * @param Pad $pad
     * @return array
     */
    public function getLaunchesByPad(Pad $pad): array
    {
        $launches = [];

        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("padId", "=", $pad->getUUID())
            ->get();

        foreach ($result as $launch)
        {
            $launches[] = $this->buildLaunchFromDatabaseResult($launch);
        }

        return $launches;
    }

    /**
     * @param Model $result
     * @return Launch
     */
    private function buildLaunchFromDatabaseResult(Model $result): Launch
    {
        $launch = new Launch();

        if (isset($result->uuid)) {
            $launch->setUUID($result->uuid);
        }

        if (isset($result->name)) {
            $launch->setName($result->name);
        }

        if (isset($result->slug)) {
            $launch->setSlug($result->slug);
        }

        if (isset($result->description)) {
            $launch->setDescription($result->description);
        }

        if (isset($result->name)) {
            $launch->setName($result->name);
        }

        if (isset($result->rocketId)) {
            $launch->setRocket($this->rocketManager->getRocketByUUID($result->rocketId));
        }

        if (isset($result->providerId)) {
            $launch->setProvider($this->providerManager->getProviderByUUID($result->providerId));
        }

        if (isset($result->padId)) {
            $launch->setPad($this->padManager->getPadByUUID($result->padId));
        }

        if (
            isset($result->startWinOpen, $result->startWinClose, $result->startNet)
            && $result->startWinOpen !== null
            && $result->startWinClose !== null
            && $result->startNet !== null
        ) {
            $launchTime = new LaunchTime();

            $launchTime->setLaunchWinOpen($this->toDateTime($result->startWinOpen));
            $launchTime->setLaunchWinClose($this->toDateTime($result->startWinClose));
            $launchTime->setLaunchNet($this->toDateTime($result->startNet));

            $launch->setLaunchTime($launchTime);
        }

        $launch->setPublished($result->published ?? false);

        return $launch;
    }

    private function toDateTime(string $timeString): DateTime {
        return DateTime::createFromFormat("Y-m-d H:i:s", $timeString);
    }

}
