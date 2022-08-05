<?php

namespace App\Interfaces\AwsS3;

use App\Services\ServiceResponse;

interface IStorageService
{
    public function store(
        mixed  $file,
        string $fileName,
        string $filePath
    ): ServiceResponse;
}
