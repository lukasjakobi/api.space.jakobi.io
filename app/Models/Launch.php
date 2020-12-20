<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Utils\HasNameSlug;
use App\Models\Utils\HasUUID;

class Launch
{

    use HasUUID;
    use HasNameSlug;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var LaunchStatus
     */
    private LaunchStatus $status;

    /**
     * @var Rocket
     */
    private Rocket $rocket;

    /**
     * @var Provider
     */
    private Provider $provider;

    /**
     * @var Pad
     */
    private Pad $pad;

    /**
     * @var array
     */
    private array $tags;

    /**
     * @var string|null
     */
    private ?string $livestreamURL;

    /**
     * @var LaunchTime
     */
    private LaunchTime $launchTime;

    /**
     * @var bool
     */
    private bool $published;

    /**
     * Launch constructor.
     */
    public function __construct()
    {
        $this->tags = [];
        $this->livestreamURL = null;
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
