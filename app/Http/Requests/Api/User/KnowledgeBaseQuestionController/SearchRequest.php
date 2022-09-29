<?php

namespace App\Http\Requests\Api\User\KnowledgeBaseQuestionController;

use App\Http\Requests\Api\BaseApiRequest;

class SearchRequest extends BaseApiRequest
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
            'pageIndex' => 'required|integer|min:0',
            'pageSize' => 'required|integer|min:1',
        ];
    }
}
