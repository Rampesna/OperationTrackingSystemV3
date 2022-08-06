<?php

namespace App\Interfaces\AwsS3;

use App\Services\ServiceResponse;

interface IStorageService
{
    /**
     * @param mixed $file
     * @param string $filePath
     */
    public function store(
        mixed  $file,
        string $filePath
    ): ServiceResponse;

    /**
     * @param string $key
     */
    public function getByKey(
        string $key
    ): ServiceResponse;
}
