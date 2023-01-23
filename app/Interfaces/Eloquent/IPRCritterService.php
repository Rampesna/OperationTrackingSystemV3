<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPRCritterService extends IEloquentService
{
    /**
     * @param int $prCardId
     * @param string $name
     * @param float $minTarget
     * @param float $minTargetPercent
     * @param float $defaultTarget
     * @param float $defaultTargetPercent
     * @param float $maxTarget
     * @param float $maxTargetPercent
     * @param float $generalPercent
     *
     * @return ServiceResponse
     */
    public function create(
        int    $prCardId,
        string $name,
        float  $minTarget,
        float  $minTargetPercent,
        float  $defaultTarget,
        float  $defaultTargetPercent,
        float  $maxTarget,
        float  $maxTargetPercent,
        float  $generalPercent
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     * @param float $minTarget
     * @param float $minTargetPercent
     * @param float $defaultTarget
     * @param float $defaultTargetPercent
     * @param float $maxTarget
     * @param float $maxTargetPercent
     * @param float $generalPercent
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        float  $minTarget,
        float  $minTargetPercent,
        float  $defaultTarget,
        float  $defaultTargetPercent,
        float  $maxTarget,
        float  $maxTargetPercent,
        float  $generalPercent
    ): ServiceResponse;


    /**
     * @param int $prCardId
     *
     * @return ServiceResponse
     */
    public function getAllByCardId(int $prCardId): ServiceResponse;
}
