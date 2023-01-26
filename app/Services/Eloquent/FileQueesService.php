<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFileQueesService;
use App\Models\Eloquent\FileQuees;
use App\Services\ServiceResponse;

/**
 *
 */
class FileQueesService implements IFileQueesService
{

    /**
     * @param string $fileName
     * @param string $fileS3Path
     * @param int $transactionTypeId
     * @param int $statusId
     * @param int $uploaderId
     * @param string $uploaderType
     * @return ServiceResponse
     */
    public function create(
        string $fileName,
        string $fileS3Path,
        int    $transactionTypeId,
        int    $statusId,
        int    $uploaderId,
        string $uploaderType
    ): ServiceResponse
    {
        $file = new FileQuees();
        $file->file_name = $fileName;
        $file->file_s3_path = $fileS3Path;
        $file->transaction_type_id = $transactionTypeId;
        $file->status_id = $statusId;
        $file->uploader_id = $uploaderId;
        $file->uploader_type = $uploaderType;
        $file->save();
        return new ServiceResponse(true, "File Quees Created", 200, $file);
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        $files = FileQuees::all();
        return new ServiceResponse(true, "File Quees Fetched", 200, $files);
    }

    /**
     * @param int $id
     * @return ServiceResponse
     */
    public function getById(int $id): ServiceResponse
    {
        $file = FileQuees::find($id);
        if ($file) {
            return new ServiceResponse(true, "File Quees Fetched", 200, $file);
        }
        return new ServiceResponse(false, "File Quees Not Found", 404, null);
    }

    /**
     * @param int $id
     * @return ServiceResponse
     */
    public function delete(int $id): ServiceResponse
    {
        $file = $this->getById($id);
        if ($file->isSuccess()) {
            $file->getData()->delete();
            return new ServiceResponse(true, "File Quees Deleted", 200, null);
        } else {
            return new ServiceResponse(false, "File Quees Not Found", 404, null);
        }
    }

    public function update(
        int    $id,
        string $fileName,
        string $fileS3Path,
        int    $transactionTypeId,
        int    $statusId,
        int    $uploaderId,
        string $uploaderType
    ): ServiceResponse
    {
        $file = $this->getById($id);
        if ($file->isSuccess()) {
            $file->getData()->file_name = $fileName;
            $file->getData()->file_s3_path = $fileS3Path;
            $file->getData()->transaction_type_id = $transactionTypeId;
            $file->getData()->status_id = $statusId;
            $file->getData()->uploader_id = $uploaderId;
            $file->getData()->uploader_type = $uploaderType;
            $file->getData()->save();
            return new ServiceResponse(true, "File Quees Updated", 200, $file->getData());
        } else {
            return new ServiceResponse(false, "File Quees Not Found", 404, null);
        }
    }

    public function getByUploader(
        int $uploaderId,
        string $uploaderType,
        ?string $keyword,
        ?string $startDate,
        ?string $endDate,
        ?array $statusIds,
        ?array $transactionTypeIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            "File Quees Fetched",
            200,
            FileQuees::where('uploader_id', $uploaderId)
                ->where('uploader_type', $uploaderType)
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('file_name', 'like', '%' . $keyword . '%');
                })
                ->when($startDate, function ($query, $startDate) {
                    return $query->where('created_at', '>=', $startDate);
                })
                ->when($endDate, function ($query, $endDate) {
                    return $query->where('created_at', '<=', $endDate);
                })
                ->when($statusIds, function ($query, $statusIds) {
                    return $query->whereIn('status_id', $statusIds);
                })
                ->when($transactionTypeIds, function ($query, $transactionTypeIds) {
                    return $query->whereIn('transaction_type_id', $transactionTypeIds);
                })
                ->get()
        );
    }
}
