<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Interfaces\AwsS3\IStorageService;
use App\Interfaces\Eloquent\IFileService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\Punishment;
use Barryvdh\DomPDF\Facade as PDF;
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

    public function downloadByKey(Request $request)
    {
        if ($request->key) {
            $exploded = explode('/', $request->key);
            $fileName = end($exploded);
            $fileFromStorage = $this->storageService->getByKey(
                $request->key
            );
            if ($fileFromStorage->isSuccess()) {
                file_put_contents(public_path('downloads/' . $fileName), $fileFromStorage->getData()['Body']->getContents());
                return response()->download(public_path('downloads/' . $fileName), $fileName, [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function createPdf(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        $punishment = Punishment::with(['category'])->find($request->id);
        $employee = Employee::find($punishment->employee_id);
        $position = Position::with(['company', 'title'])->where('employee_id', $employee->id)->orderBy('start_date', 'desc')->where('end_date', null)->first();
        return $pdf = PDF::loadView('user.documents.punishment.' . $punishment->category->id, [
            'employee' => $employee,
            'position' => $position
        ], [], 'UTF-8')->download($employee->name . ' ' . $punishment->date . ' ' . $punishment->category->name . '.pdf');
    }
}
