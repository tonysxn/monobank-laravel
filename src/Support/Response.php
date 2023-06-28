<?php

namespace Neverlxsss\Monobank\Support;

class Response
{
    private int|null $statusCode;
    private object|null $body;
    private string|null $error;

    public function __construct(int $statusCode = null, object $body = null, string $error = null)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->error = $error;
    }

    /**
     * Get status code
     * @return int|null
     */
    public function statusCode(): int|null
    {
        return $this->statusCode;
    }

    /**
     * Get body
     * @return object|null
     */
    public function body(): object|null
    {
        return $this->body;
    }

    /**
     * Is request success
     * @return bool
     */
    public function okay(): bool
    {
        return empty($this->error);
    }

    /**
     * Get error message
     * @return string|null
     */
    public function error(): string|null
    {
        return $this->error;
    }

    /**
     * Is request success and status code is 200
     * @return bool
     */
    public function success(): bool
    {
        return $this->okay() && $this->statusCode == 200;
    }
}
