<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPRCalculate;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\PRCard;
use App\Models\Eloquent\PRCritter;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PRCalculate implements IPRCalculate
{
    /**
     * @param int $jobDepartmentId
     * @param string $date
     * @param int $calculateType
     *
     * @return ServiceResponse
     */
    public function calculate(
        int    $prCardId,
        string $date,
        int    $calculateType
    ): ServiceResponse
    {
        $prCard = PRCard::find($prCardId);
        $prCritters = PRCritter::where('p_r_card_id', $prCardId)->get();
        $employees = Employee::where('job_department_id', $prCard->job_department_id)->get();

        $startDate = date('Y-m-01', strtotime($date));
        $endDate = date('Y-m-t', strtotime($date));

        foreach ($employees as $employee) {

            foreach ($prCritters as $critter) {
                $dataList = DB::select('SELECT * FROM pr_card_' . $prCard->code . '_' . $prCard->version . ' where employee_id = ' . $employee->id . ' and `' . $critter->column_code . '_' . $critter->version . '` is not null and date between \'' . $startDate . '\' and \'' . $endDate . '\'');
                $resultList = collect();
                foreach ($dataList as $data) {
                    $columnName = $critter->column_code . '_' . $critter->version;
                    $result = 0;
                    if ($critter->min_target < $critter->default_target) {
                        if ($data->$columnName > $critter->min_target) {
                            if ($data->$columnName > $critter->default_target) {
                                if ($data->$columnName >= $critter->max_target) {
                                    $result = 100;
                                } else {
                                    $result = $data->$columnName * $critter->default_target_percent / 100;
                                }
                            } else if ($data->$columnName == $critter->default_target) {
                                $result = $data->$columnName * $critter->default_target_percent / 100;
                            } else {
                                $result = $data->$columnName * $critter->min_target_percent / 100;
                            }
                        } else if ($data->$columnName == $critter->min_target) {
                            $result = $data->$columnName * $critter->min_target_percent / 100;
                        } else {
                            $result = 0;
                        }
                    } else {
                        if ($data->$columnName > $critter->min_target) {
                            $result = 0;
                        } else if ($data->$columnName == $critter->min_target) {
                            $result = $data->$columnName * $critter->min_target_percent / 100;
                        } else {
                            if ($data->$columnName > $critter->default_target) {
                                $result = $data->$columnName * $critter->min_target_percent / 100;
                            } else if ($data->$columnName == $critter->default_target) {
                                $result = $data->$columnName * $critter->default_target_percent / 100;
                            } else {
                                if ($data->$columnName > $critter->max_target) {
                                    $result = $data->$columnName * $critter->default_target_percent / 100;
                                } else {
                                    $result = 100;
                                }
                            }
                        }
                    }

                    $resultList->push([
                        'date' => $data->date,
                        'employee_id' => $employee->id,
                        $critter->column_code . '_' . $critter->version => $result,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }



                if (!Schema::hasTable('pr_card_results_' . $prCard->code . '_' . $prCard->version)) {
//                    Schema::create('pr_result_' . $prCard->code . '_' . $prCard->version, function ($table) {
//                        $table->bigIncrements('id');
//                        $table->date('date');
//                        $table->integer('employee_id');
//                        $table->string('column_code');
//                        $table->string('critter_name');
//                        $table->float('result');
//                        $table->timestamps();
//                    });

                    Schema::create('pr_card_results_' . $prCard->code . '_' . $prCard->version, function ($table) {
                        $table->increments('id');
                        $table->dateTime('date');
                        $table->bigInteger('employee_id');
                        $table->timestamps();
                    });

                    foreach (PRCritter::where('p_r_card_id', $prCard->id)->get() as $prCardCritter) {
                        Schema::table('pr_card_results_' . $prCard->code . '_' . $prCard->version, function ($table) use ($prCardCritter) {
                            $table->string($prCardCritter->column_code . '_' . $prCardCritter->version)->nullable();
                        });
                    }
                }

                if ($calculateType == 1) {
                    DB::table('pr_card_results_' . $prCard->code . '_' . $prCard->version)->insert($resultList->toArray());
                } else {
                    DB::table('pr_card_results_' . $prCard->code . '_' . $prCard->version)->insert([
                        'date' => date('Y-m-d H:i:s', strtotime($date)),
                        'employee_id' => $employee->id,
                        $critter->column_code . '_' . $critter->version => $resultList->count() == 0 ? 0 : $resultList->sum($critter->column_code . '_' . $critter->version) / $resultList->count(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }

            }

        }

        return new ServiceResponse(
            true,
            'success',
            200,
            null
        );
    }

    public function getAll(): ServiceResponse
    {
        // TODO: Implement getAll() method.
    }

    public function getById(int $id): ServiceResponse
    {
        // TODO: Implement getById() method.
    }

    public function delete(int $id): ServiceResponse
    {
        // TODO: Implement delete() method.
    }

    public function getResult(int $prCardId, string $date): ServiceResponse
    {
        // TODO: Implement getResult() method.
    }
}
