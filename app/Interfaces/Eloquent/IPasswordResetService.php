<?php

namespace App\Interfaces\Eloquent;

use App\Models\Eloquent\PasswordReset;
use App\Services\ServiceResponse;
use Illuminate\Support\Str;

interface IPasswordResetService extends IEloquentService
{
    /**
     * @param string $token
     *
     * @return ServiceResponse
     */
    public function getByToken(
        string $token
    );

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $datetime
     *
     * @return ServiceResponse
     */
    public function checkPasswordReset(
        string $relationType,
        int    $relationId,
        string $datetime
    );

    /**
     * @param string $relationType
     * @param int $relationId
     *
     * @return ServiceResponse
     */
    public function create(
        string $relationType,
        int    $relationId
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function setUsed(
        int $id
    );
}
