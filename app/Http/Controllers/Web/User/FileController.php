<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Interfaces\AwsS3\IStorageService;
use App\Interfaces\Eloquent\IFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * @var $fileService
     */
    private $fileService;

    /**
     * @var $storageService
     */
    private $storageService;

    /**
     * @param IFileService $fileService
     */
    public function __construct(IFileService $fileService, IStorageService $storageService)
    {
        $this->fileService = $fileService;
        $this->storageService = $storageService;
    }

    public function download(Request $request)
    {
        if ($request->id) {
            $file = $this->fileService->getById(
                $request->id
            );
            if ($file->isSuccess()) {
                $fileFromStorage = $this->storageService->getByKey(
                    $file->getData()->path
                );
                if ($fileFromStorage->isSuccess()) {
                    $randomString = Str::random(10);
                    file_put_contents(public_path('downloads/' . $randomString . '_' . $file->getData()->name), $fileFromStorage->getData()['Body']->getContents());
                    return response()->download(public_path('downloads/' . $randomString . '_' . $file->getData()->name), $file->getData()->name, [
                        'Content-Type' => $file->getData()->type,
                    ]);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
