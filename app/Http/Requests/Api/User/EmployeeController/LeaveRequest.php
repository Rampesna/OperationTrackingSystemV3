<?php

namespace App\Http\Requests\Api\User\EmployeeController;

use App\Http\Requests\Api\BaseApiRequest;

class LeaveRequest extends BaseApiRequest
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
            'employeeId' => 'required|integer',
            'employeeGuid' => 'required|integer',
            'date' => 'required|string',
            'leavingReasonId' => 'required|integer',
        ];
    }
}
