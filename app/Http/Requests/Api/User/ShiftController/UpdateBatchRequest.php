<?php

namespace App\Http\Requests\Api\User\ShiftController;

use App\Http\Requests\Api\BaseApiRequest;

class UpdateBatchRequest extends BaseApiRequest
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
            'date' => 'required|date',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i',
        ];
    }
}
