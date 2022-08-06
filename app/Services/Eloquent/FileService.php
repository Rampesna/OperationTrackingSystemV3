<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFileService;
use App\Models\Eloquent\File;
use App\Services\ServiceResponse;

class FileService implements IFileService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All files',
            200,
            File::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $file = File::find($id);
        if ($file) {
            return new ServiceResponse(
                true,
                'File',
                200,
                $file
            );
        } else {
            return new ServiceResponse(
                false,
                'File not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $fileResponse = $this->getById($id);
        if ($fileResponse->isSuccess()) {
            return new ServiceResponse(
                true,
                'File deleted',
                200,
                $fileResponse->getData()->delete()
            );
        } else {
            return $fileResponse;
        }
    }

    /**
     * @param int $uploaderId
     * @param string $uploaderType
     * @param int $relationId
     * @param string $relationType
     * @param string|null $type
     * @param string|null $icon
     * @param string $name
     * @param string $path
     */
    public function create(
        int     $uploaderId,
        string  $uploaderType,
        int     $relationId,
        string  $relationType,
        ?string $type,
        ?string $icon,
        string  $name,
        string  $path
    ): ServiceResponse
    {
        $file = new File;
        $file->uploader_id = $uploaderId;
        $file->uploader_type = $uploaderType;
        $file->relation_id = $relationId;
        $file->relation_type = $relationType;
        $file->type = $type;
        $file->icon = $icon;
        $file->name = $name;
        $file->path = $path;
        $file->save();

        return new ServiceResponse(
            true,
            'File created',
            201,
            $file
        );
    }

    /**
     * @param int $relationId
     * @param string $relationType
     *
     * @return ServiceResponse
     */
    public function getByRelation(
        int    $relationId,
        string $relationType
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Files',
            200,
            File::where('relation_id', $relationId)->where('relation_type', $relationType)->get()
        );
    }
}
