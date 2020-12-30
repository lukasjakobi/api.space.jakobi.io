<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Provider;
use Illuminate\Support\Facades\DB;

class ProviderManager
{

    private const TABLE = "rl_provider";

    /**
     * @param int $id
     * @return Provider|null
     */
    public function getProviderById(int $id): ?Provider
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "abbreviation", "wikiURL", "imageURL", "logoURL"
            ])
            ->where("id", "=", $id)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildProviderFromDatabaseResult($result);
    }

    /**
     * @param string $slug
     * @return Provider|null
     */
    public function getProviderBySlug(string $slug): ?Provider
    {
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "abbreviation", "wikiURL", "imageURL", "logoURL"
            ])
            ->where("slug", "=", $slug)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildProviderFromDatabaseResult($result);
    }

    /**
     * @param string $orderBy
     * @param string $orderMethod
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getProviders(string $orderBy, string $orderMethod, int $limit, int $page): array
    {
        $providers = [];
        $result = DB::table(self::TABLE)
            ->select([
                "id", "name", "slug", "abbreviation", "wikiURL", "imageURL", "logoURL"
            ])
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->orderBy($orderBy, $orderMethod)
            ->get();

        foreach ($result as $item)
        {
            $providers[] = $this->buildProviderFromDatabaseResult($item);
        }

        return $providers;
    }

    public function getTotalAmount(): int
    {
        return DB::table(self::TABLE)->selectRaw("COUNT(*) as total")->first()->total ?? 0;
    }

    /**
     * @param $result
     * @return Provider
     */
    private function buildProviderFromDatabaseResult($result): Provider
    {
        $provider = new Provider();

        if (isset($result->id)) {
            $provider->setId($result->id);
        }

        if (isset($result->name)) {
            $provider->setName($result->name);
        }

        if (isset($result->slug)) {
            $provider->setSlug($result->slug);
        }

        if (isset($result->abbreviation)) {
            $provider->setAbbreviation($result->abbreviation);
        }

        if (isset($result->wikiURL)) {
            $provider->setWikiURL($result->wikiURL);
        }

        if (isset($result->imageURL)) {
            $provider->setImageURL($result->imageURL);
        }

        if (isset($result->logoURL)) {
            $provider->setLogoURL($result->logoURL);
        }

        return $provider;
    }
}
