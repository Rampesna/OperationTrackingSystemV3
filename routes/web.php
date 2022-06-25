<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return \App\Models\Eloquent\UserRole::find(1)->userPermissions;
});

Route::get('/', function () {
    return redirect()->route('user.web.authentication.login.index');
});
