<?php

declare(strict_types=1);

namespace App\Models\Utils;

trait HasId
{

    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
