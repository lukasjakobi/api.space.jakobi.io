<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Rocket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RocketManager
{

    private const TABLE = "rl_rocket";

    /**
     * @param string $uuid
     * @return Rocket|null
     */
    public function getRocketByUUID(string $uuid): ?Rocket
    {
        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "wikiURL", "imageURL"
            ])
            ->where("uuid", "=", $uuid)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildRocketFromDatabaseResult($result);
    }

    /**
     * @param Model $result
     * @return Rocket
     */
    private function buildRocketFromDatabaseResult(Model $result): Rocket
    {
        $rocket = new Rocket();

        if (isset($result->uuid)) {
            $rocket->setUUID($result->uuid);
        }

        if (isset($result->name)) {
            $rocket->setName($result->name);
        }

        if (isset($result->slug)) {
            $rocket->setSlug($result->slug);
        }

        if (isset($result->wikiURL)) {
            $rocket->setWikiURL($result->wikiURL);
        }

        if (isset($result->imageURL)) {
            $rocket->setImageURL($result->imageURL);
        }

        return $rocket;
    }
}
