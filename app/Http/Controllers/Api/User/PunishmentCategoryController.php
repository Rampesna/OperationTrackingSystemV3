<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PunishmentCategoryController\GetAllRequest;
use App\Interfaces\Eloquent\IPunishmentCategoryService;
use App\Traits\Response;

class PunishmentCategoryController extends Controller
{
    use Response;

    /**
     * @var $punishmentCategoryService
     */
    private $punishmentCategoryService;

    /**
     * @param IPunishmentCategoryService $punishmentCategoryService
     */
    public function __construct(IPunishmentCategoryService $punishmentCategoryService)
    {
        $this->punishmentCategoryService = $punishmentCategoryService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->punishmentCategoryService->getAll();
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
}
