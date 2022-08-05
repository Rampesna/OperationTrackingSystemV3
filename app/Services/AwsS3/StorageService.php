<?php

namespace App\Services\AwsS3;

use App\Interfaces\AwsS3\IStorageService;
use App\Services\ServiceResponse;

class StorageService extends AwsS3Service implements IStorageService
{
    public function store(
        mixed  $file,
        string $fileName,
        string $filePath
    ): ServiceResponse
    {
        $response = $this->getFileSystem()->put($filePath . $fileName, file_get_contents($file));

        return new ServiceResponse(
            true,
            'File uploaded successfully',
            200,
            $response
        );
    }
}
