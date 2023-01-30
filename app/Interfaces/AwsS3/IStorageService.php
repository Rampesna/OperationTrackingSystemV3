<?php

namespace App\Interfaces\AwsS3;

use App\Services\ServiceResponse;

interface IStorageService
{
    /**
     * @param mixed $file
     * @param string $filePath
     * @param string|null $fileName
     */
    public function store(
        mixed   $file,
        string  $filePath,
        ?string $fileName = null
    ): ServiceResponse;

    /**
     * @param string $key
     */
    public function getByKey(
        string $key
    ): ServiceResponse;
}
