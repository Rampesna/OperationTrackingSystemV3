<?php

namespace App\Http\Requests\Api\User\PersonSystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetPersonWorkToDoTypeRequest extends BaseApiRequest
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
            'jobCode' => 'required',
            'guids' => 'required|array',
        ];
    }
}
