<?php

namespace App\Http\Requests\Api\User\OperationApi\ExamSystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetExamsRequest extends BaseApiRequest
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
            'name' => 'required',
            'duration' => 'required',
            'date' => 'required',
        ];
    }
}
