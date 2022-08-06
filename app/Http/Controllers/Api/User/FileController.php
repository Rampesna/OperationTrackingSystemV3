<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\AwsS3\IStorageService;
use App\Interfaces\Eloquent\IFileService;
use App\Http\Requests\Api\User\FileController\GetAllRequest;
use App\Http\Requests\Api\User\FileController\UploadRequest;
use App\Http\Requests\Api\User\FileController\DownloadRequest;
use App\Http\Requests\Api\User\FileController\GetByIdRequest;
use App\Http\Requests\Api\User\FileController\GetByRelationRequest;
use App\Http\Requests\Api\User\FileController\DeleteRequest;
use App\Traits\Response;

class FileController extends Controller
{
    use Response;

    /**
     * @var $fileService
     */
    private $fileService;

    /**
     * @var $storageService
     */
    private $storageService;

    /**
     * @param IFileService $fileService
     */
    public function __construct(IFileService $fileService, IStorageService $storageService)
    {
        $this->fileService = $fileService;
        $this->storageService = $storageService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->fileService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->fileService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByRelationRequest $request
     */
    public function getByRelation(GetByRelationRequest $request)
    {
        $getByRelationResponse = $this->fileService->getByRelation(
            $request->relationId,
            $request->relationType
        );
        if ($getByRelationResponse->isSuccess()) {
            return $this->success(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getData(),
                $getByRelationResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByRelationResponse->getMessage(),
                $getByRelationResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UploadRequest $request
     */
    public function upload(UploadRequest $request)
    {
        $storeResponse = $this->storageService->store(
            $request->file('file'),
            $request->filePath
        );
        if ($storeResponse->isSuccess()) {
            $createResponse = $this->fileService->create(
                $request->user()->id,
                'App\\Models\\Eloquent\\User',
                $request->relationId,
                $request->relationType,
                $request->file('file')->getClientMimeType(),
                $request->icon,
                $request->file('file')->getClientOriginalName(),
                $storeResponse->getData()
            );
            if ($createResponse->isSuccess()) {
                return $this->success(
                    $createResponse->getMessage(),
                    $createResponse->getData(),
                    $createResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $createResponse->getMessage(),
                    $createResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $storeResponse->getMessage(),
                $storeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DownloadRequest $request
     */
    public function download(DownloadRequest $request)
    {
        $file = $this->fileService->getById(
            $request->id
        );
        if ($file->isSuccess()) {
            $fileFromStorage = $this->storageService->getByKey(
                $file->getData()->path
            );
            if ($fileFromStorage->isSuccess()) {
                header("Content-Type: {$fileFromStorage->getData()['ContentType']}");
                echo $fileFromStorage->getData()['Body'];
                return null;
            } else {
                return $this->error(
                    $fileFromStorage->getMessage(),
                    $fileFromStorage->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $file->getMessage(),
                $file->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->fileService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
