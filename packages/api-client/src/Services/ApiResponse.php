<?php

namespace AvrilloCodeTest\ApiClient\Services;

final class ApiResponse
{
    /**
     * @var ?int $statusCode
     */
    protected ?int $statusCode = null;

    /**
     * @var array $headers
     */
    protected array $headers = [];

    /**
     * @var mixed $body
     */
    protected mixed $body = null;

    /**
     * Set the status code for the supplied response.
     * 
     * @param ?int $statusCode
     * @return ApiResponse
     */
    public function setStatusCode(?int $statusCode = null): ApiResponse
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Get the status code for the response.
     * 
     * @return ?int
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * Set the headers for the supplied response.
     * 
     * @param array $headers
     * @return ApiResponse
     */
    public function setHeaders(array $headers = []): ApiResponse
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Get the headers for the response.
     * 
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set the body for the supplied response.
     * 
     * @param mixed $body
     * @return ApiResponse
     */
    public function setBody(mixed $body = null): ApiResponse
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get the body for the response.
     * 
     * @return array
     */
    public function getBody(): mixed
    {
        return $this->body;
    }
}