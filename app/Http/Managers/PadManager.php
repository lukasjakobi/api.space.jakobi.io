<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Pad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PadManager
{

    private const TABLE = "rl_pad";

    /**
     * @param string $uuid
     * @return Pad|null
     */
    public function getPadByUUID(string $uuid): ?Pad
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

        return $this->buildPadFromDatabaseResult($result);
    }

    /**
     * @param Model $result
     * @return Pad
     */
    private function buildPadFromDatabaseResult(Model $result): Pad
    {
        $pad = new Pad();

        if (isset($result->uuid)) {
            $pad->setUUID($result->uuid);
        }

        if (isset($result->name)) {
            $pad->setName($result->name);
        }

        if (isset($result->slug)) {
            $pad->setSlug($result->slug);
        }

        if (isset($result->wikiURL)) {
            $pad->setWikiURL($result->wikiURL);
        }

        if (isset($result->imageURL)) {
            $pad->setImageURL($result->imageURL);
        }

        return $pad;
    }
}
