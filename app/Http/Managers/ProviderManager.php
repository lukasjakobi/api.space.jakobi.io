<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;

class ProviderManager
{

    private const TABLE = "rl_provider";

    /**
     * @param string $uuid
     * @return Provider|null
     */
    public function getProviderByUUID(string $uuid): ?Provider
    {
        $result = DB::table(self::TABLE)
            ->select([
                "uuid", "name", "slug", "abbreviation", "wikiURL", "imageURL"
            ])
            ->where("uuid", "=", $uuid)
            ->first();

        if ($result === null) {
            return null;
        }

        return $this->buildProviderFromDatabaseResult($result);
    }

    /**
     * @param Model $result
     * @return Provider
     */
    private function buildProviderFromDatabaseResult(Model $result): Provider
    {
        $provider = new Provider();

        if (isset($result->uuid)) {
            $provider->setUUID($result->uuid);
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
