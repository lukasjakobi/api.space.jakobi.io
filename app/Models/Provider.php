<?php

declare(strict_types=1);

namespace App\Models;


use App\Models\Utils\HasNameSlug;
use App\Models\Utils\HasId;

class Provider extends Model
{

    use HasId;
    use HasNameSlug;

    /**
     * @var string|null
     */
    private ?string $abbreviation = null;

    /**
     * @var string|null
     */
    private ?string $wikiURL = null;

    /**
     * @var string|null
     */
    private ?string $imageURL = null;

    /**
     * @return array
     */
    public function export(): array
    {
        $array = $this->toArray();

        foreach ($array as $key=>$value) {
            if ($value === null) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "abbreviation" => $this->abbreviation,
            "wikiURL" => $this->wikiURL,
            "imageURL" => $this->imageURL,
        ];
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

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
     * @param string $abbreviation
     * @return Provider
     */
    public function setAbbreviation(string $abbreviation): Provider
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @param string|null $wikiURL
     * @return Provider
     */
    public function setWikiURL(?string $wikiURL): Provider
    {
        $this->wikiURL = $wikiURL;

        return $this;
    }

    /**
     * @param string|null $imageURL
     * @return Provider
     */
    public function setImageURL(?string $imageURL): Provider
    {
        $this->imageURL = $imageURL;

        return $this;
    }
}
