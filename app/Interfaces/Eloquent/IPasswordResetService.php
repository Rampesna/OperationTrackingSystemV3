<?php

namespace App\Interfaces\Eloquent;

use App\Models\Eloquent\PasswordReset;
use Illuminate\Support\Str;

interface IPasswordResetService extends IEloquentService
{
    /**
     * @param string $token
     */
    public function getByToken(
        string $token
    );

    /**
     * @param string $relationType
     * @param int $relationId
     * @param string $datetime
     */
    public function checkPasswordReset(
        string $relationType,
        int    $relationId,
        string $datetime
    );

    /**
     * @param string $relationType
     * @param int $relationId
     */
    public function create(
        string $relationType,
        int    $relationId
    );

    /**
     * @param int $id
     */
    public function setUsed(
        int $id
    );
}
