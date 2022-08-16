<?php

namespace App\Http\Requests\Api\User\BatchSmsController;

use App\Http\Requests\Api\BaseApiRequest;

class SendToNumbersRequest extends BaseApiRequest
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
            'numbers' => 'required|array',
            'message' => 'required|string',
        ];
    }
}
