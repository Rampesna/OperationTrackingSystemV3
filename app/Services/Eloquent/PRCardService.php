<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPRCardService;
use App\Models\Eloquent\PRCard;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PRCardService implements IPRCardService
{
    /**
     * @param int $jobDepartmentId
     *
     * @return ServiceResponse
     */
    public function getByJobDepartmentId(
        int $jobDepartmentId,
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'PR Cards by jobDepartmentId',
            200,
            PRCard::with([
                'jobDepartment'
            ])->where('job_department_id', $jobDepartmentId)->get()
        );
    }

    /**
     * @param int $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
    ): ServiceResponse
    {
        $prCard = new PRCard();
        $prCard->name = $name;
        $prCard->code = md5(Str::random(32));
        $prCard->version = 1;
        $prCard->save();

        Schema::create('pr_card_' . $prCard->code . '_' . 1, function ($table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->bigInteger('employee_id');
            $table->tinyInteger('worked_day_count');
            $table->timestamps();
        });

        return new ServiceResponse(
            true,
            'PR Card created successfully',
            200,
            $prCard
        );
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {

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

    }
}
