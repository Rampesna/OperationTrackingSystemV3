<?php

namespace App\Services\AwsS3;

use Illuminate\Support\Facades\Storage;

class AwsS3Service
{
    /**
     * @var $fileSystem
     */
    private $fileSystem;

    public function __construct()
    {
        $this->fileSystem = Storage::disk('s3');
    }

    public function getFileSystem()
    {
        return $this->fileSystem;
    }
}
