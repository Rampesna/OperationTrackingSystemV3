<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/abc', [\App\Http\Controllers\Home\HomeController::class, 'abc'])->name('home');
Route::get('/test', [\App\Http\Controllers\Home\HomeController::class, 'oneSignalTest'])->name('test');
Route::get('/test2', [\App\Http\Controllers\Home\HomeController::class, 'test2'])->name('test2');
Route::get('/test3', [\App\Http\Controllers\Home\HomeController::class, 'test3'])->name('test3');

Route::get('s3T', function (\Illuminate\Http\Request $request) {

    set_time_limit(86400);

    $storageService = new \App\Services\AwsS3\StorageService;

    $dataList = json_decode(file_get_contents(public_path('old_files_for_s3.json')), true);
    $response = collect();

//    return $dataList;

    foreach ($dataList as $data) {
        $response->push([
            'id' => $data['id'],
        ]);

        $filePath = public_path('old_files/' . $data['old_full_path']);
        $fullPath = 'uploads/' . $data['new_path_for_s3'];

        if (file_exists($filePath)) {
            $storageService->storeFromAsset(
                $filePath,
                $fullPath
            );

            $getFile = \App\Models\Eloquent\File::find($data['id']);

            if ($getFile) {
                $getFile->path = $fullPath;
                $getFile->save();
            }
        }
    }

    return 'Tamamlandı';
});
