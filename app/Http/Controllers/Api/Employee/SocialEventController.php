<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\SocialEventController\GetAllByDateOrderedWithImagesRequest;
use App\Interfaces\Eloquent\ISocialEventService;
use App\Traits\Response;

class SocialEventController extends Controller
{
    use Response;

    /**
     * @var $socialEventService
     */
    private $socialEventService;

    /**
     * @param ISocialEventService $socialEventService
     */
    public function __construct(ISocialEventService $socialEventService)
    {
        $this->socialEventService = $socialEventService;
    }


    /**
     * @param GetAllByDateOrderedWithImagesRequest $request
     */
    public function getAllByDateOrderedWithImages(GetAllByDateOrderedWithImagesRequest $request)
    {
        $indexResponse = $this->socialEventService->getAllByDateOrderedWithImages();
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
}
