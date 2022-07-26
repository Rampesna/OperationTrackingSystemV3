<?php

namespace App\Http\Requests\Api\User\PaymentController;

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
            'typeId' => 'required|integer',
            'statusId' => 'required|integer',
            'date' => 'required',
            'amount' => 'required|integer',
            'description' => 'required|string',
        ];
    }
}
