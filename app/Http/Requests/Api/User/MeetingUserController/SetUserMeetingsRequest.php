<?php

namespace App\Http\Requests\Api\User\MeetingUserController;

use App\Http\Requests\Api\BaseApiRequest;

class SetUserMeetingsRequest extends BaseApiRequest
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
            'userId' => 'required|integer',
            'meetingIds' => 'required|array',
            'meetingIds.*' => 'required|integer',
        ];
    }
}
