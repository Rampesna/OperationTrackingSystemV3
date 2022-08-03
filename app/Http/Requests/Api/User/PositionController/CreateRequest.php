<?php

namespace App\Http\Requests\Api\User\PositionController;

use App\Http\Requests\Api\BaseApiRequest;

class CreateRequest extends BaseApiRequest
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
            'companyId' => 'required|integer',
            'branchId' => 'required|integer',
            'departmentId' => 'required|integer',
            'titleId' => 'required|integer',
            'startDate' => 'required|date',
        ];
    }
}
