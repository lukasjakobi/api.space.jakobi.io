<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Utils\HasId;

class LaunchStatus extends Model
{

    use HasId;

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
