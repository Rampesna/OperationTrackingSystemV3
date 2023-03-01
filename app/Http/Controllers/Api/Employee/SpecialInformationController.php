<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\SpecialInformationController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\Employee\SpecialInformationController\UpdateRequest;
use App\Interfaces\Eloquent\ISpecialInformationService;
use App\Traits\Response;

class SpecialInformationController extends Controller
{
    use Response;

    /**
     * @var $specialInformationService
     */
    private $specialInformationService;

    /**
     * @param ISpecialInformationService $specialInformationService
     */
    public function __construct(ISpecialInformationService $specialInformationService)
    {
        $this->specialInformationService = $specialInformationService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $response = $this->specialInformationService->getByEmployeeId(
            $request->user()->id
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
     */
    public function update(UpdateRequest $request)
    {
        $response = $this->specialInformationService->update(
            $request->user()->id,
            $request->city,
            $request->currentOffice,
            $request->address,
            $request->workingStatus,
            $request->generalStatus,
            $request->generalEquipmentStatus,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->workableDate,
            $request->generalNotes
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
}
