<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $keyword = 'talha';
    return $users = \App\Models\Eloquent\Company::with([
        'users'
    ])->whereIn('id', [1, 2, 3])->get()->map(function ($company) use ($keyword) {
        return $company->users->map(function ($user) use ($keyword) {
            if ($keyword) {
                if (strpos($user->name, $keyword)) {
                    return $user;
                }
            } else {
                return $user;
            }
        });
    })->collapse()->unique('id')->filter(function ($value, $key) {
        return $value != null;
    });
});

Route::get('/', function () {
    return redirect()->route('user.web.authentication.login.index');
});
