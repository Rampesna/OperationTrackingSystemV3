<?php

namespace App\Http\Requests\Api\User\ShiftController;

use App\Http\Requests\Api\BaseApiRequest;

class CreateBatchRequest extends BaseApiRequest
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
            'shifts' => 'required|array',
            'shifts.*.employeeId' => 'required|integer',
            'shifts.*.shiftGroupId' => 'required|integer',
            'shifts.*.startDate' => 'required|date',
            'shifts.*.endDate' => 'required|date',
        ];
    }
}
