<?php

namespace App\Http\Requests\Api\User\FileQueesController;

use App\Http\Requests\Api\BaseApiRequest;

class GetByUploaderRequest extends BaseApiRequest
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
            'uploaderId' => 'required|integer',
            'uploaderType' => 'required|string',
            'keyword' => 'nullable|string',
            'startDate' => 'nullable|string',
            'endDate' => 'nullable|string',
            'statusIds' => 'nullable|array',
            'transactionTypeIds' => 'nullable|array',

        ];
    }
}
