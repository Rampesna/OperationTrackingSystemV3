<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPunishmentCategoryService;
use App\Models\Eloquent\PunishmentCategory;
use App\Services\ServiceResponse;

class PunishmentCategoryService implements IPunishmentCategoryService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All punishment categories',
            200,
            PunishmentCategory::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $punishmentCategory = PunishmentCategory::find($id);
        if ($punishmentCategory) {
            return new ServiceResponse(
                true,
                'Punishment category',
                200,
                $punishmentCategory
            );
        } else {
            return new ServiceResponse(
                false,
                'Permit type not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $punishmentCategory = $this->getById($id);
        if ($punishmentCategory->isSuccess()) {
            return new ServiceResponse(
                true,
                'Punishment category deleted',
                200,
                $punishmentCategory->getData()->delete()
            );
        } else {
            return $punishmentCategory;
        }
    }
}
