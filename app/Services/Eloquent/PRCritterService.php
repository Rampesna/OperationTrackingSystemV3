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
    ): ServiceResponse
    {
        $prGeneralPercentSum = PRCritter::where('p_r_card_id', $prCardId)->sum('general_percent');
        if ($prGeneralPercentSum + $generalPercent > 100) {
            return new ServiceResponse(
                false,
                'Sum of general percent of all critters cannot be more than 100',
                400,
                null
            );
        }
        $prCritter = new PRCritter();
        $prCritter->p_r_card_id = $prCardId;
        $prCritter->column_code = str_replace('-', '_', Str::uuid());
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

        Schema::table('pr_card_' . $prCard->code . '_' . $prCard->version, function ($table) use ($prCritter) {
            $table->string($prCritter->column_code . '_' . 1)->nullable();
        });

        return new ServiceResponse(
            true,
            'PR Critter created successfully',
            200,
            $prCritter
        );
    }

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
    ): ServiceResponse
    {
        $prCritter = $this->getById($id);
        if ($prCritter->isSuccess()) {
            $prCritter = $prCritter->getData();
            $prGeneralPercentSum = PRCritter::where('p_r_card_id', $prCritter->p_r_card_id)->sum('general_percent');
            if ($prGeneralPercentSum + $generalPercent > 100) {
                return new ServiceResponse(
                    false,
                    'Sum of general percent of all critters cannot be more than 100',
                    400,
                    null
                );
            }
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

            if (Schema::hasTable('pr_card_results_' . $prCard->code . '_' . $prCard->version)) {
                Schema::table('pr_card_results_' . $prCard->code . '_' . $prCard->version, function ($table) use ($prCritter) {
                    $table->string($prCritter->column_code . '_' . $prCritter->version)->nullable();
                });
            }

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

    public function getAllByCardId(int $prCardId): ServiceResponse
    {
        $prCritters = PRCritter::where('p_r_card_id', $prCardId)->get();

        return new ServiceResponse(
            true,
            'PR Critters fetched successfully',
            200,
            $prCritters
        );
    }
}
