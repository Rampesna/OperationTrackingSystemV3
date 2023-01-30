<?php

namespace App\Services\AwsS3;

use App\Interfaces\AwsS3\IStorageService;
use App\Services\ServiceResponse;

class StorageService extends AwsS3Service implements IStorageService
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
    ): ServiceResponse
    {
        $key = $filePath . ($fileName ?? $file->getFilename());
        $this->getClient()->putObject([
            'Bucket' => $this->getBucket(),
            'Key' => $key,
            'Body' => fopen($file->getPath() . '/' . $file->getFilename(), 'r'),
            'ACL' => 'public-read'
        ]);

        return new ServiceResponse(
            true,
            'File uploaded',
            200,
            $key
        );
    }

    /**
     * @param mixed $filePath
     * @param string $filePath
     */
    public function storeFromAsset(
        mixed  $filePath,
        string $fullPath
    ): ServiceResponse
    {
        $response = $this->getClient()->putObject([
            'Bucket' => $this->getBucket(),
            'Key' => $fullPath,
            'Body' => fopen($filePath, 'r'),
            'ACL' => 'public-read'
        ]);

        return new ServiceResponse(
            true,
            'File uploaded',
            200,
            $fullPath
        );
    }

    /**
     * @param string $key
     */
    public function getByKey(
        string $key
    ): ServiceResponse
    {
        $response = $this->getClient()->getObject([
            'Bucket' => $this->getBucket(),
            'Key' => $key
        ]);

        return new ServiceResponse(
            true,
            'File',
            200,
            $response
        );
    }
}
