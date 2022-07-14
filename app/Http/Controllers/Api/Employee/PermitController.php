<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\PermitController\GetDateBetweenRequest;
use App\Http\Requests\Api\Employee\PermitController\GetByIdRequest;
use App\Http\Requests\Api\Employee\PermitController\CreateRequest;
use App\Http\Requests\Api\Employee\PermitController\UpdateRequest;
use App\Interfaces\Eloquent\IPermitService;
use App\Traits\Response;

class PermitController extends Controller
{
    use Response;

    /**
     * @var $permitService
     */
    private $permitService;

    /**
     * @param IPermitService $permitService
     */
    public function __construct(IPermitService $permitService)
    {
        $this->permitService = $permitService;
    }

    /**
     * @param GetDateBetweenRequest $request
     */
    public function getDateBetween(GetDateBetweenRequest $request)
    {
        $getDateBetweenResponse = $this->permitService->getDateBetween(
            $request->user()->id,
            $request->startDate,
            $request->endDate
        );
        if ($getDateBetweenResponse->isSuccess()) {
            return $this->success(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getData(),
                $getDateBetweenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getDateBetweenResponse->getMessage(),
                $getDateBetweenResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $permit = $this->permitService->getById(
            $request->id
        );
        if ($permit->isSuccess()) {
            if (!$permit->getData() || $permit->getData()->employee_id != $request->user()->id) {
                return $this->error('Permit not found', 404);
            }
            return $this->success(
                $permit->getMessage(),
                $permit->getData(),
                $permit->getStatusCode()
            );
        } else {
            return $this->error(
                $permit->getMessage(),
                $permit->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->permitService->create(
            $request->user()->id,
            $request->typeId,
            1,
            $request->startDate,
            $request->endDate,
            $request->description
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
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $permit = $this->permitService->getById(
            $request->id
        );
        if ($permit->isSuccess()) {
            if (!$permit->getData() || $permit->getData()->employee_id != $request->user()->id) {
                return $this->error('Permit not found', 404);
            }

            if ($permit->getData()->status_id != 1) {
                return $this->error('You can not update permit with status other than pending', 403);
            }

            $updateResponse = $this->permitService->update(
                $request->id,
                $request->user()->id,
                $request->typeId,
                1,
                $request->startDate,
                $request->endDate,
                $request->description
            );

            if ($updateResponse->isSuccess()) {
                return $this->success(
                    $updateResponse->getMessage(),
                    $updateResponse->getData(),
                    $updateResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $updateResponse->getMessage(),
                    $updateResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $permit->getMessage(),
                $permit->getStatusCode()
            );
        }
    }
}
