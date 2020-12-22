<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Launch;
use App\Models\LaunchTime;
use App\Models\Pad;
use App\Models\Provider;
use App\Models\Rocket;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
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

    /**
     * LaunchManager constructor.
     */
    public function __construct()
    {
        $this->rocketManager = new RocketManager();
        $this->providerManager = new ProviderManager();
        $this->padManager = new PadManager();
    }

    /**
     * @param int $id
     * @return Launch|null
     */
    public function getLaunchById(int $id): ?Launch
    {
        $result = DB::table(self::TABLE)
            ->select([
               "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("id", "=", $id)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildLaunchFromDatabaseResult($result);
    }

    /**
     * @param string $slug
     * @return Launch|null
     */
    public function getLaunchBySlug(string $slug): ?Launch
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("slug", "=", $slug)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildLaunchFromDatabaseResult($result);
    }

    /**
     * @param bool $upcoming
     * @param string $orderBy
     * @param string $orderMethod
     * @param int $limit
     * @param int $page
     * @param bool $detailed
     * @return array
     */
    public function getLaunches(bool $upcoming, string $orderBy, string $orderMethod, int $limit, int $page, bool $detailed): array
    {
        if ($limit > Defaults::REQUEST_LIMIT_MAX) {
            $limit = Defaults::REQUEST_LIMIT_MAX;
        }

        $currentTime = Carbon::now()->toDateTimeString();
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->orderBy($orderBy, $orderMethod)
            ->where(Defaults::DATABASE_COLUMN_START_NET, ($upcoming ? '>' : '<'), $currentTime)
            ->get();

        return $this->extractLaunches($result, $detailed);
    }

    /**
     * @param Provider $provider
     * @param int $page
     * @param int $limit
     * @param bool $detailed
     * @return array
     */
    public function getLaunchesByProvider(Provider $provider, int $limit, int $page, bool $detailed): array
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->where("providerId", "=", $provider->getId())
            ->get();

        return $this->extractLaunches($result, $detailed);
    }

    /**
     * @param Rocket $rocket
     * @param int $page
     * @param int $limit
     * @param bool $detailed
     * @return array
     */
    public function getLaunchesByRocket(Rocket $rocket, int $limit, int $page, bool $detailed): array
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->where("rocketId", "=", $rocket->getId())
            ->get();

        return $this->extractLaunches($result, $detailed);
    }

    /**
     * @param Pad $pad
     * @param int $page
     * @param int $limit
     * @param bool $detailed
     * @return array
     */
    public function getLaunchesByPad(Pad $pad, int $limit, int $page, bool $detailed): array
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("padId", "=", $pad->getId())
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return $this->extractLaunches($result, $detailed);
    }

    /**
     * @param string $query
     * @param int $limit
     * @param int $page
     * @param bool $detailed
     * @return array
     */
    public function searchLaunches(string $query, int $limit, int $page, bool $detailed): array
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "description", "statusId", "rocketId","padId","providerId", "tags", "livestreamURL", "startWinOpen", "startWinClose", "startNet", "published"
            ])
            ->where("tags", "LIKE", $query)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return $this->extractLaunches($result, $detailed);
    }

    /**
     * @param Collection $result
     * @param bool $detailed
     * @return array
     */
    private function extractLaunches(Collection $result, bool $detailed): array
    {
        $launches = [];

        foreach ($result as $launch)
        {
            $launches[] = $this->buildLaunchFromDatabaseResult($launch, $detailed);
        }

        return $launches;
    }

    /**
     * @param $result
     * @param bool $detailed
     * @return Launch
     */
    private function buildLaunchFromDatabaseResult($result, bool $detailed = true): Launch
    {
        $launch = new Launch();

        if (isset($result->id)) {
            $launch->setId($result->id);
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

        if (isset($result->tags)) {
            try {
                $launch->setTags(json_decode($result->tags, true, 512, JSON_THROW_ON_ERROR));
            } catch (\JsonException $ignored) { }
        }

        if (
            $detailed
            && isset($result->rocketId)
        ) {
            $launch->setRocket($this->rocketManager->getRocketById($result->rocketId));
        }

        if (
            $detailed
            && isset($result->providerId)
        ) {
            $launch->setProvider($this->providerManager->getProviderById($result->providerId));
        }

        if (
            $detailed
            && isset($result->padId)
        ) {
            $launch->setPad($this->padManager->getPadById($result->padId));
        }

        if (
            $detailed
            && isset($result->startWinOpen, $result->startWinClose, $result->startNet)
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

        $launch->setPublished(isset($result->published) ? (bool)$result->published : false);

        return $launch;
    }

    private function toDateTime(string $timeString): DateTime {
        return DateTime::createFromFormat("Y-m-d H:i:s", $timeString);
    }

}
