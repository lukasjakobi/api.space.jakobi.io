<?php

declare(strict_types=1);

namespace App\Models\Utils;

trait HasNameSlug
{

    /**
     * @var string|null
     */
    private ?string $name = null;
    /**
     * @var string|null
     */
    private ?string $slug = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
