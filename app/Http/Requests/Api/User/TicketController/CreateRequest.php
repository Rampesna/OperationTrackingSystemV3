<?php

namespace App\Http\Requests\Api\User\TicketController;

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
            'creatorType' => 'required|string',
            'creatorId' => 'required|integer',
            'relationType' => 'required|string',
            'relationId' => 'required|integer',
            'priorityId' => 'required|integer',
            'statusId' => 'required|integer',
            'title' => 'required|string',
        ];
    }
}
