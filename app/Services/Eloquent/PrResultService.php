<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPrResultService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\JobDepartment;
use App\Models\Eloquent\PRCard;
use App\Models\Eloquent\PRCritter;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\DB;

class PrResultService implements IPrResultService
{

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
        $responseResults = collect();
        $prCard = PRCard::find($prCardId);
        $employees = JobDepartment::find($prCard->job_department_id)->employees;
        $critters = $prCard->prCritters;
        foreach ($critters as $critter) {
            $results = DB::table('pr_card_results_' . $prCard->code . '_' . $prCard->version)->
            where($critter->column_code . '_' . $critter->version, '!=', null)->
            whereBetween('date', [
                date('Y-m-01', strtotime($date)),
                date('Y-m-t', strtotime($date))
            ])->get()->map(function ($result) use ($critter) {
                $columnName = $critter->column_code . '_' . $critter->version;
                $result->critterName = PRCritter::where('column_code', $critter->column_code)->first()?->name;
                $result->employee = Employee::find($result->employee_id)->name;
                $result->result = $result->$columnName;
                return $result;
            });

//            $lastResult = [
//                'name' => $results->first()?->employee
//            ];
//            foreach ($results as $item) {
//                $lastResult[$item->critterName] = $item->result;
//            }

            $responseResults->push($results);
        }

        $employeeResults = [];
        foreach ($employees as $employee) {
            $employeeResults[$employee->id] = [
                'Personel' => $employee->name
            ];

            foreach ($responseResults as $array) {
                $employeeData = $array->where('employee_id', $employee->id)->first();
                if ($employeeData) {
                    $employeeResults[$employee->id][$employeeData->critterName] = $employeeData->result;
                }
            }
        }

        return new ServiceResponse(true, 'Success', 200, $employeeResults);
    }
}
