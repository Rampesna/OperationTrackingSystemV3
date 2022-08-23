<?php

namespace App\Http\Controllers;

class PerformanceCalculationTest
{

    public function calculationTest()
    {
        (new EmployeeAnalysisApiService)->calls('2021-12-02', '2021-12-03');

        return EmployeeAnalysis::whereBetween('date', [
            '2021-12-02',
            '2021-12-03'
        ])->get();

        $employeeAnalysisApiService = new EmployeeAnalysisApiService;
        $employeeAnalysisApiService->jobAndActivities('2021-11-22', '2021-11-24');
        $employeeAnalysisApiService->breaks('2021-11-22', '2021-11-24');
        $employeeAnalysisApiService->dataScans('2021-11-22', '2021-11-24');
        $employeeAnalysisApiService->presentations('2021-11-22', '2021-11-24');

        return EmployeeMonthlyPerformance::with([
            'critters' => function ($critters) {
                $critters->with([
                    'performanceCritter'
                ]);
            }
        ])->where('employee_id', 177)->where('job_department_id', 5)->where('date', '2021-10-01')->first();

        $date = '2021-10-01';
        $jobDepartments = JobDepartment::all();
        $allEmployeeAnalyses = EmployeeAnalysis::whereBetween('date', [
            date('Y-m-01', strtotime($date)),
            date('Y-m-t', strtotime($date))
        ])->get();

        foreach ($jobDepartments as $jobDepartment) {
            $jobDepartmentEmployees = $jobDepartment->employees()->where('id', 177)->get();
            $jobDepartmentMonthlyPerformanceCritters = JobDepartmentMonthlyPerformanceCritter::with([
                'performanceCritter' => function ($performanceCritter) {
                    $performanceCritter->with([
                        'employeeAnalysisColumn'
                    ]);
                }
            ])->where('job_department_id', $jobDepartment->id)->where('date', $date)->get();

            foreach ($jobDepartmentEmployees as $jobDepartmentEmployee) {
                $employeeAnalyses = collect($allEmployeeAnalyses->where('employee_id', $jobDepartmentEmployee->id)->where('worked', 1)->all());
                $employeeMonthlyPerformance = EmployeeMonthlyPerformance::where('employee_id', $jobDepartmentEmployee->employee_id)->where('date', $date)->first();
                if (!$employeeMonthlyPerformance) {
                    $employeeMonthlyPerformance = new EmployeeMonthlyPerformance;
                    $employeeMonthlyPerformance->employee_id = $jobDepartmentEmployee->id;
                    $employeeMonthlyPerformance->job_department_id = $jobDepartment->id;
                    $employeeMonthlyPerformance->date = $date;
                    $employeeMonthlyPerformance->save();
                }
                foreach ($jobDepartmentMonthlyPerformanceCritters as $jobDepartmentMonthlyPerformanceCritter) {
                    if ($jobDepartmentMonthlyPerformanceCritter->calculating_type == 1) {
                        $performanceForEvaluate = count($employeeAnalyses) > 0 ? $employeeAnalyses->sum($jobDepartmentMonthlyPerformanceCritter->performanceCritter->employeeAnalysisColumn->column) / count($employeeAnalyses) : 0;
                    } else {
                        $performanceForEvaluate = $employeeAnalyses->sum($jobDepartmentMonthlyPerformanceCritter->performanceCritter->employeeAnalysisColumn->column);
                    }

                    $performance = 0;

                    print_r($jobDepartmentEmployee->name . ' Adlı Personelin ' . $jobDepartmentMonthlyPerformanceCritter->performanceCritter->name . ' Parametreisndeki Performansı Değerlendiriliyor. Değer(' . $performanceForEvaluate . ')');
                    print_r('<br><br>');

                    if ($jobDepartmentMonthlyPerformanceCritter->target_increasing == 1) {
                        if ($performanceForEvaluate >= $jobDepartmentMonthlyPerformanceCritter->minimum_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->minimum_target_percent;
                        }

                        if ($performanceForEvaluate >= $jobDepartmentMonthlyPerformanceCritter->default_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->default_target_percent;
                        }

                        if ($performanceForEvaluate >= $jobDepartmentMonthlyPerformanceCritter->maximum_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->maximum_target_percent;
                        }
                    } else {
                        if ($performanceForEvaluate <= $jobDepartmentMonthlyPerformanceCritter->minimum_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->minimum_target_percent;
                        }

                        if ($performanceForEvaluate <= $jobDepartmentMonthlyPerformanceCritter->default_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->default_target_percent;
                        }

                        if ($performanceForEvaluate <= $jobDepartmentMonthlyPerformanceCritter->maximum_target) {
                            $performance = $jobDepartmentMonthlyPerformanceCritter->percent * 100 / $jobDepartmentMonthlyPerformanceCritter->maximum_target_percent;
                        }
                    }

                    $employeeMonthlyPerformanceCritter = new EmployeeMonthlyPerformanceCritter;
                    $employeeMonthlyPerformanceCritter->employee_monthly_performance_id = $employeeMonthlyPerformance->id;
                    $employeeMonthlyPerformanceCritter->performance_critter_id = $jobDepartmentMonthlyPerformanceCritter->performanceCritter->id;
                    $employeeMonthlyPerformanceCritter->result = $performanceForEvaluate;
                    $employeeMonthlyPerformanceCritter->performance = $performance;
                    $employeeMonthlyPerformanceCritter->save();
                }
            }
        }

        return 'OK';

    }

}
