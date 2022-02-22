<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// all routes for citizens will be here

Route::get('/survey', 'SurveyController@index');
Route::post('/survey', 'SurveyController@survey');

Route::middleware('survey')->group(function () {
    Route::get('/reserve', 'ReseservationController@index');
    Route::post('/reserve/map/{campaign}', 'ReseservationController@reserve');

    Route::get('/reserve/step2', 'ReseservationController@form');
    Route::post('/reserve/step2', 'ReseservationController@store');
});

Route::get('/notifications', 'NotificationController@index');

Route::get('/articles', 'ArticleController@index');
Route::get('/articles/{article}', 'ArticleController@show');