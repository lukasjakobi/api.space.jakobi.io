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
                "id", "name", "slug", "abbreviation", "wikiURL", "imageURL"
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
                "id", "name", "slug", "abbreviation", "wikiURL", "imageURL"
            ])
            ->where("slug", "=", $slug)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildProviderFromDatabaseResult($result);
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

        return $provider;
    }
}
