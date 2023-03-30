<?php

namespace App\Http\Requests\Api\User\OperationApi\ExamSystemController;

use App\Http\Requests\Api\BaseApiRequest;

class SetQuestionsRequest extends BaseApiRequest
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
            'examId' => 'required|integer',
            'question' => 'required|string',
            'questionType' => 'required|integer',
            'order' => 'required|integer',
        ];
    }
}
