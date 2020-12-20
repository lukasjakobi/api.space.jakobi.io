<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Utils\HasNameSlug;
use App\Models\Utils\HasUUID;

class Rocket
{

    use HasUUID;
    use HasNameSlug;

    /**
     * @var string|null
     */
    private ?string $wikiURL = null;

    /**
     * @var string|null
     */
    private ?string $imageURL = null;

    /**
     * @return string|null
     */
    public function getWikiURL(): ?string
    {
        return $this->wikiURL;
    }

    /**
     * @return string|null
     */
    public function getImageURL(): ?string
    {
        return $this->imageURL;
    }

    /**
     * @param string|null $wikiURL
     * @return Rocket
     */
    public function setWikiURL(?string $wikiURL): Rocket
    {
        $this->wikiURL = $wikiURL;

        return $this;
    }

    /**
     * @param string|null $imageURL
     * @return Rocket
     */
    public function setImageURL(?string $imageURL): Rocket
    {
        $this->imageURL = $imageURL;

        return $this;
    }
}
