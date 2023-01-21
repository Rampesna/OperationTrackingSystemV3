<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPRCritterService;
use App\Models\Eloquent\PRCard;
use App\Models\Eloquent\PRCritter;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PRCritterService implements IPRCritterService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'PR Critters fetched successfully',
            200,
            PRCritter::all()
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
        $prCritter = PRCritter::find($id);
        if ($prCritter) {
            return new ServiceResponse(
                true,
                'PR Critter fetched successfully',
                200,
                $prCritter
            );
        } else {
            return new ServiceResponse(
                false,
                'PR Critter not found',
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
        $prCritter = $this->getById($id);
        if ($prCritter->isSuccess()) {
            return new ServiceResponse(
                true,
                'PR Critter deleted successfully',
                200,
                $prCritter->getData()->delete()
            );
        } else {
            return $prCritter;
        }
    }

    /**
     * @param int $prCardId
     * @param int $jobDepartmentId
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
        int    $jobDepartmentId,
        string $name,
        float  $minTarget,
        float  $minTargetPercent,
        float  $defaultTarget,
        float  $defaultTargetPercent,
        float  $maxTarget,
        float  $maxTargetPercent,
        float  $generalPercent
    ): ServiceResponse
    {
        $prCritter = new PRCritter();
        $prCritter->p_r_card_id = $prCardId;
        $prCritter->column_code = str_replace('-', '_', Str::uuid());
        $prCritter->job_department_id = $jobDepartmentId;
        $prCritter->name = $name;
        $prCritter->min_target = $minTarget;
        $prCritter->min_target_percent = $minTargetPercent;
        $prCritter->default_target = $defaultTarget;
        $prCritter->default_target_percent = $defaultTargetPercent;
        $prCritter->max_target = $maxTarget;
        $prCritter->max_target_percent = $maxTargetPercent;
        $prCritter->general_percent = $generalPercent;
        $prCritter->save();

        $prCard = PRCard::where('id', $prCardId)->first();

        Schema::table('pr_card_' . $prCard->code . '_' . 1, function ($table) use ($prCritter) {
            $table->string($prCritter->column_code . '_' . $prCritter->version)->nullable();
        });

//        DB::select('CREATE TABLE IF NOT EXISTS `pr_critter_' . $prCritter->code . '_' . 1 . '` (
//            `id` int(11) NOT NULL AUTO_INCREMENT,
//            `date` datetime NOT NULL,
//            `employee_id` bigint(20) NOT NULL,
//            `worked_day_count` tinyint NOT NULL,
//            `version` smallint NOT NULL,
//            `column_name` varchar(255) NOT NULL,
//            `data` varchar(255) NOT NULL,
//            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//            PRIMARY KEY (`id`))');


        return new ServiceResponse(
            true,
            'PR Critter created successfully',
            200,
            $prCritter
        );
    }

    /**
     * @param int $id
     * @param int $jobDepartmentId
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
        int    $jobDepartmentId,
        string $name,
        float  $minTarget,
        float  $minTargetPercent,
        float  $defaultTarget,
        float  $defaultTargetPercent,
        float  $maxTarget,
        float  $maxTargetPercent,
        float  $generalPercent
    ): ServiceResponse
    {
        $prCritter = $this->getById($id);
        if ($prCritter->isSuccess()) {
            $prCritter = $prCritter->getData();
            $prCritter->job_department_id = $jobDepartmentId;
            $prCritter->name = $name;
            $prCritter->min_target = $minTarget;
            $prCritter->min_target_percent = $minTargetPercent;
            $prCritter->default_target = $defaultTarget;
            $prCritter->default_target_percent = $defaultTargetPercent;
            $prCritter->max_target = $maxTarget;
            $prCritter->max_target_percent = $maxTargetPercent;
            $prCritter->general_percent = $generalPercent;
            $prCritter->version = $prCritter->version + 1;
            $prCritter->save();

            $prCard = PRCard::where('id', $prCritter->p_r_card_id)->first();
            Schema::table('pr_card_' . $prCard->code . '_' . $prCard->version, function ($table) use ($prCritter) {
                $table->string($prCritter->column_code . '_' . $prCritter->version)->nullable();
            });

//            DB::select('CREATE TABLE IF NOT EXISTS `pr_critter_' . $prCritter->code . '_' . $prCritter->version . '` (
//            `id` int(11) NOT NULL AUTO_INCREMENT,
//            `date` datetime NOT NULL,
//            `employee_id` bigint(20) NOT NULL,
//            `worked_day_count` tinyint NOT NULL,
//            `version` smallint NOT NULL,
//            `column_name` varchar(255) NOT NULL,
//            `data` varchar(255) NOT NULL,
//            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//            PRIMARY KEY (`id`))');

            return new ServiceResponse(
                true,
                'PR Critter updated successfully',
                200,
                $prCritter
            );
        } else {
            return $prCritter;
        }
    }
}
