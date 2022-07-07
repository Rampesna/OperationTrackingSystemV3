<?php

namespace App\Services;

class ServiceResponse
{
    public bool $isSuccess;

    public string $message;

    public mixed $data;

    public int $statusCode;

    public function __construct(
        bool   $isSuccess,
        string $message,
        int    $statusCode,
        mixed  $data
    )
    {
        $this->isSuccess = $isSuccess;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

}
