<?php

namespace App\Http\Requests\Api\User\FileController;

use App\Http\Requests\Api\BaseApiRequest;

class UploadRequest extends BaseApiRequest
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
            'file' => 'required|file',
            'filePath' => 'required|string',
            'relationId' => 'required|integer',
            'relationType' => 'required|string',
        ];
    }
}
