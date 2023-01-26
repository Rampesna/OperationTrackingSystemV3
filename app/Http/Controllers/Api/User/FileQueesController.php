<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\FileQueesController\CreateRequest;
use App\Http\Requests\Api\User\FileQueesController\DeleteRequest;
use App\Http\Requests\Api\User\FileQueesController\GetAllRequest;
use App\Http\Requests\Api\User\FileQueesController\GetByIdRequest;
use App\Http\Requests\Api\User\FileQueesController\UpdateRequest;
use App\Interfaces\Eloquent\IFileQueesService;
use App\Traits\Response;

/**
 *
 */
class FileQueesController extends Controller
{
    use Response;

    /**
     * @var IFileQueesService
     */
    private $fileQueesService;

    /**
     * @param IFileQueesService $fileQueesService
     */
    public function __construct(IFileQueesService $fileQueesService)
    {
        $this->fileQueesService = $fileQueesService;
    }


    /**
     * @param GetAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(GetAllRequest $request)
    {
        $response = $this->fileQueesService->getAll();
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(GetByIdRequest $request)
    {
        $response = $this->fileQueesService->getById($request->id);
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }


    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request)
    {
        $response = $this->fileQueesService->create(
            $request->fileName,
            $request->fileS3Path,
            $request->transactionTypeId,
            $request->statusId,
            $request->uploaderId,
            $request->uploaderType

        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }


    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $response = $this->fileQueesService->update(
            $request->id,
            $request->fileName,
            $request->fileS3Path,
            $request->transactionTypeId,
            $request->statusId,
            $request->uploaderId,
            $request->uploaderType
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }


    /**
     * @param DeleteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteRequest $request)
    {
        $response = $this->fileQueesService->delete($request->id);
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }
}
