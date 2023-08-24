<?php

namespace App\Http\Requests\Api\User\FileController;

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
            'fileList' => 'required|array',
            'fileList.*.relationId' => 'required|integer',
            'fileList.*.relationType' => 'required|string',
            'fileList.*.type' => 'nullable|string',
            'fileList.*.icon' => 'nullable|string',
            'fileList.*.name' => 'required|string',
            'fileList.*.path' => 'required|string',
        ];
    }
}
