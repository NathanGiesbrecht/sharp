<?php

// API routes
Route::group([
    'prefix' => '/sharp/api',
    'middleware' => ['web', 'sharp_errors', 'sharp_authorizations', 'sharp_context'],
    'namespace' => 'Code16\Sharp\Http\Api'
], function() {

    Route::get("/list/{entityKey}")
        ->name("code16.sharp.api.list")
        ->uses('EntitiesListController@show');

    Route::get("/form/{entityKey}")
        ->name("code16.sharp.api.form.create")
        ->uses('FormController@create');

    Route::get("/form/{entityKey}/{instanceId}")
        ->name("code16.sharp.api.form.edit")
        ->uses('FormController@edit');

    Route::post("/form/{entityKey}/{instanceId}")
        ->name("code16.sharp.api.form.update")
        ->uses('FormController@update');

    Route::delete("/form/{entityKey}/{instanceId}")
        ->name("code16.sharp.api.form.delete")
        ->uses('FormController@delete');

    Route::post("/form/{entityKey}")
        ->name("code16.sharp.api.form.store")
        ->uses('FormController@store');

});

Route::post('/sharp/api/upload')
    ->name("code16.sharp.api.form.upload")
    ->uses('Code16\Sharp\Http\Api\FormUploadController@store');

// Web routes
Route::group([
    'prefix' => '/sharp',
    'middleware' => ['web'],
    'namespace' => 'Code16\Sharp\Http'
], function() {

    Route::get('/login')
        ->name("code16.sharp.login")
        ->uses('LoginController@create');

    Route::post('/login')
        ->name("code16.sharp.login.post")
        ->uses('LoginController@store');

    Route::group([
        'middleware' => ['sharp_errors', 'sharp_authorizations'],
    ], function() {

        Route::get('/list/{entityKey}')
            ->name("code16.sharp.list")
            ->uses('ListController@show');

        Route::get('/form/{entityKey}/{instanceId}')
            ->name("code16.sharp.edit")
            ->uses('FormController@edit');

        Route::get('/form/{entityKey}')
            ->name("code16.sharp.create")
            ->uses('FormController@create');
    });

});

// Localization
Route::get('/vendor/sharp/lang.js')
    ->name('code16.sharp.assets.lang')
    ->uses('Code16\Sharp\Http\LangController@index');