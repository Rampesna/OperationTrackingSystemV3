<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ISocialEventService extends IEloquentService
{
    /**
     * @return ServiceResponse
     */
    public function getAllByDateOrdered(): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function getAllByDateOrderedWithImages(): ServiceResponse;

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string $youtubeVideoUrl
     *
     * @return ServiceResponse
     */
    public function create(
        string $name,
        string $description,
        string $date,
        string $youtubeVideoUrl
    ): ServiceResponse;

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $date
     * @param string $youtubeVideoUrl
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name,
        string $description,
        string $date,
        string $youtubeVideoUrl
    ): ServiceResponse;
}
