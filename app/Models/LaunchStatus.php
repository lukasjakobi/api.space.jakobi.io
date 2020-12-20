<?php

declare(strict_types=1);

namespace App\Models;

class LaunchStatus
{

    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $displayName;

    /**
     * @var bool
     */
    private bool $cancelled;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    /**
     * @param int $id
     * @return LaunchStatus
     */
    public function setId(int $id): LaunchStatus
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param bool $cancelled
     * @return LaunchStatus
     */
    public function setCancelled(bool $cancelled): LaunchStatus
    {
        $this->cancelled = $cancelled;

        return $this;
    }

    /**
     * @param string $displayName
     * @return LaunchStatus
     */
    public function setDisplayName(string $displayName): LaunchStatus
    {
        $this->displayName = $displayName;

        return $this;
    }
}
