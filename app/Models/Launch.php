<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Managers\Defaults;
use App\Models\Utils\HasNameSlug;
use App\Models\Utils\HasId;

class Launch extends Model
{

    use HasId;
    use HasNameSlug;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var LaunchStatus|null
     */
    private ?LaunchStatus $status = null;

    /**
     * @var Rocket|null
     */
    private ?Rocket $rocket = null;

    /**
     * @var Provider|null
     */
    private ?Provider $provider = null;

    /**
     * @var Pad|null
     */
    private ?Pad $pad = null;

    /**
     * @var array
     */
    private array $tags = [];

    /**
     * @var string|null
     */
    private ?string $livestreamURL = null;

    /**
     * @var LaunchTime|null
     */
    private ?LaunchTime $launchTime = null;

    /**
     * @var bool
     */
    private bool $published = Defaults::STATUS_PUBLISHED;

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
            "description" => $this->description ?? null,
            "status" => $this->status !== null ? $this->status->export() : null,
            "rocket" => $this->rocket !== null ? $this->rocket->export() : null,
            "provider" => $this->provider !== null ? $this->provider->export() : null,
            "pad" => $this->pad !== null ? $this->pad->export() : null,
            "tags" => $this->tags,
            "livestreamURL" => $this->livestreamURL ?? null,
            "launchTime" => $this->launchTime !== null ? $this->launchTime->export() : null,
            "published" => $this->published,
        ];
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return LaunchStatus
     */
    public function getStatus(): LaunchStatus
    {
        return $this->status;
    }

    /**
     * @return LaunchTime
     */
    public function getLaunchTime(): LaunchTime
    {
        return $this->launchTime;
    }

    /**
     * @return Pad
     */
    public function getPad(): Pad
    {
        return $this->pad;
    }

    /**
     * @return Provider
     */
    public function getProvider(): Provider
    {
        return $this->provider;
    }

    /**
     * @return Rocket
     */
    public function getRocket(): Rocket
    {
        return $this->rocket;
    }

    public function hasTags(): bool
    {
        return empty($this->tags);
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return string|null
     */
    public function getLivestreamURL(): ?string
    {
        return $this->livestreamURL;
    }

    public function hasLivestream(): bool
    {
        return $this->livestreamURL !== null;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param LaunchTime $launchTime
     */
    public function setLaunchTime(LaunchTime $launchTime): void
    {
        $this->launchTime = $launchTime;
    }

    /**
     * @param Pad $pad
     */
    public function setPad(Pad $pad): void
    {
        $this->pad = $pad;
    }

    /**
     * @param Provider $provider
     */
    public function setProvider(Provider $provider): void
    {
        $this->provider = $provider;
    }

    /**
     * @param Rocket $rocket
     */
    public function setRocket(Rocket $rocket): void
    {
        $this->rocket = $rocket;
    }

    /**
     * @param LaunchStatus $status
     */
    public function setStatus(LaunchStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @param string|null $livestreamURL
     */
    public function setLivestreamURL(?string $livestreamURL): void
    {
        $this->livestreamURL = $livestreamURL;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }
}
