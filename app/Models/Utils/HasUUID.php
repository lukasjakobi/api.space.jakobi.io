<?php

declare(strict_types=1);

namespace App\Models\Utils;

trait HasUUID
{

    /**
     * @var string
     */
    private string $uuid;

    /**
     * @return string
     */
    public function getUUID(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUUID(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
