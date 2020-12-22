<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Rocket;
use Illuminate\Support\Facades\DB;

class RocketManager
{

    private const TABLE = "rl_rocket";

    /**
     * @param int $id
     * @return Rocket|null
     */
    public function getRocketById(int $id): ?Rocket
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "wikiURL", "imageURL"
            ])
            ->where("id", "=", $id)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildRocketFromDatabaseResult($result);
    }

    /**
     * @param string $slug
     * @return Rocket|null
     */
    public function getRocketBySlug(string $slug): ?Rocket
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "wikiURL", "imageURL"
            ])
            ->where("slug", "=", $slug)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildRocketFromDatabaseResult($result);
    }

    /**
     * @param string $orderBy
     * @param string $orderMethod
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getRockets(string $orderBy, string $orderMethod, int $limit, int $page): array
    {
        $rockets = [];
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "wikiURL", "imageURL"
            ])
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->orderBy($orderBy, $orderMethod)
            ->get();

        foreach ($result as $item)
        {
            $rockets[] = $this->buildRocketFromDatabaseResult($item);
        }

        return $rockets;
    }

    /**
     * @param $result
     * @return Rocket
     */
    private function buildRocketFromDatabaseResult($result): Rocket
    {
        $rocket = new Rocket();

        if (isset($result->id)) {
            $rocket->setId($result->id);
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
