<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ICareerService;
use App\Http\Requests\Api\User\CareerController\IndexRequest;
use App\Http\Requests\Api\User\CareerController\SendBatchSmsRequest;
use App\Interfaces\MesajPaneli\IMesajPaneliService;
use App\Traits\Response;

class CareerController extends Controller
{
    use Response;

    /**
     * @var $careerService
     */
    private $careerService;

    /**
     * @var $mesajPaneliService
     */
    private $mesajPaneliService;

    /**
     * @param ICareerService $careerService
     * @param IMesajPaneliService $mesajPaneliService
     */
    public function __construct(
        ICareerService      $careerService,
        IMesajPaneliService $mesajPaneliService
    )
    {
        $this->careerService = $careerService;
        $this->mesajPaneliService = $mesajPaneliService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->careerService->index(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SendBatchSmsRequest $request
     */
    public function sendBatchSms(SendBatchSmsRequest $request)
    {
        $careers = $this->careerService->getAll();
        if ($careers->isSuccess()) {
            $phones = [];
            foreach ($careers->getData() as $career) {
                $phones[] = clearPhoneNumber($career->phone);
            }

            $this->mesajPaneliService->sendSms(
                [[
                    'msg' => $request->message,
                    'tel' => $phones
                ]]
            );
        } else {
            return $this->error(
                $careers->getMessage(),
                $careers->getStatusCode()
            );
        }
    }
}
