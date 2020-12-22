<?php

declare(strict_types=1);

namespace App\Supplier;

class Supplier
{

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $code;

    /**
     * @var string
     */
    private string $baseUrl;

    /**
     * Supplier constructor.
     * @param string $name
     * @param string $code
     * @param string $baseUrl
     */
    public function __construct(string $name, string $code, string $baseUrl)
    {
        $this->name = $name;
        $this->code = $code;
        $this->baseUrl = $baseUrl;
    }

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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
