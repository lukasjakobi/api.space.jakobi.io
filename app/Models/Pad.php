<?php

declare(strict_types=1);

namespace App\Models;


use App\Models\Utils\HasNameSlug;
use App\Models\Utils\HasUUID;

class Pad
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
     * @return Pad
     */
    public function setWikiURL(?string $wikiURL): Pad
    {
        $this->wikiURL = $wikiURL;

        return $this;
    }

    /**
     * @param string|null $imageURL
     * @return Pad
     */
    public function setImageURL(?string $imageURL): Pad
    {
        $this->imageURL = $imageURL;

        return $this;
    }
}
