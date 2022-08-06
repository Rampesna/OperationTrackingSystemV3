<?php

namespace App\Services\AwsS3;

use App\Interfaces\AwsS3\IStorageService;
use App\Services\ServiceResponse;

class StorageService extends AwsS3Service implements IStorageService
{
    /**
     * @param mixed $file
     * @param string $filePath
     */
    public function store(
        mixed  $file,
        string $filePath
    ): ServiceResponse
    {
        $response = $this->getClient()->putObject([
            'Bucket' => $this->getBucket(),
            'Key' => $filePath . $file->getClientOriginalName(),
            'Body' => fopen($file->getPath() . '/' . $file->getFilename(), 'r'),
            'ACL' => 'public-read'
        ]);

        return new ServiceResponse(
            true,
            'File uploaded',
            200,
            $filePath . $file->getClientOriginalName()
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
