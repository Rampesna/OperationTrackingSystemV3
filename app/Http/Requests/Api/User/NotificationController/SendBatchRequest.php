<?php

namespace App\Http\Requests\Api\User\NotificationController;

use App\Http\Requests\Api\BaseApiRequest;

class SendBatchRequest extends BaseApiRequest
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
            'heading' => 'required|string',
            'message' => 'required|string'
        ];
    }
}
