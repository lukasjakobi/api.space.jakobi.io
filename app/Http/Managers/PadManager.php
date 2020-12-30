<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\Pad;
use Illuminate\Support\Facades\DB;

class PadManager
{

    private const TABLE = "rl_pad";

    /**
     * @param int $id
     * @return Pad|null
     */
    public function getPadById(int $id): ?Pad
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

        return $this->buildPadFromDatabaseResult($result);
    }

    /**
     * @param string $slug
     * @return Pad|null
     */
    public function getPadBySlug(string $slug): ?Pad
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

        return $this->buildPadFromDatabaseResult($result);
    }

    public function getTotalAmount(): int
    {
        return DB::table(self::TABLE)->selectRaw("COUNT(*) as total")->first()->total ?? 0;
    }

    /**
     * @param $result
     * @return Pad
     */
    private function buildPadFromDatabaseResult($result): Pad
    {
        $pad = new Pad();

        if (isset($result->id)) {
            $pad->setId($result->id);
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
