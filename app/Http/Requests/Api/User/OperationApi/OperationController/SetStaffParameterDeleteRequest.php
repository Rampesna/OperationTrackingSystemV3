<?php

namespace App\Http\Requests\Api\User\OperationApi\OperationController;

use App\Http\Requests\Api\BaseApiRequest;

class SetStaffParameterDeleteRequest extends BaseApiRequest
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
            'shiftId' => 'required|integer',
        ];
    }
}
