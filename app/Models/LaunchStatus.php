<?php

declare(strict_types=1);

namespace App\Models;

class LaunchStatus extends Model
{

    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     */
    private ?string $displayName = null;

    /**
     * @var bool
     */
    private ?bool $cancelled = false;

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
            "displayName" => $this->displayName,
            "cancelled" => $this->cancelled
        ];
    }

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
