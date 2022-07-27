<?php

namespace App\Http\Requests\Api\User\OvertimeController;

use App\Http\Requests\Api\BaseApiRequest;

class GetDateBetweenByEmployeeIdsAndTypeIdsRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employeeIds' => 'required|array',
            'employeeIds.*' => 'required|integer',
            'typeIds' => 'required|array',
            'typeIds.*' => 'required|integer',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ];
    }
}
