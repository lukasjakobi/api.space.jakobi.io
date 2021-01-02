<?php

namespace App\Supplier;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SupplierRequest
{

    /**
     * @var string
     */
    private string $method;

    /**
     * @var string
     */
    private string $baseURL;

    /**
     * @var string
     */
    private string $path;

    private Client $client;

    /**
     * SupplierRequest constructor.
     * @param string $method
     * @param string $baseURL
     * @param string $path
     */
    public function __construct(string $method, string $baseURL, string $path)
    {
        $this->method = $method;
        $this->baseURL = $baseURL;
        $this->path = $path;
        $this->client = new Client();
    }

    public function execute(): ?object
    {
        try {
            return json_decode($this->client->request($this->method, $this->baseURL . $this->path)->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException $e) {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getBaseURL(): string
    {
        return $this->baseURL;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param string $baseURL
     */
    public function setBaseURL(string $baseURL): void
    {
        $this->baseURL = $baseURL;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}
