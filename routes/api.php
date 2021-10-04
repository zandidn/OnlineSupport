<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);

    Route::group(['prefix' => 'customer', 'as' => 'customer'], function () {
        Route::get('/questions', [QuestionController::class, 'userQuestion']);
        Route::post('/question', [QuestionController::class, 'store']);
    });

    Route::group(['prefix' => 'support', 'as' => 'support'], function () {
        Route::post('/search-question-by-user', [QuestionController::class, 'searchUserQuestion']);
        Route::post('/search-question-by-status', [QuestionController::class, 'searchQuestionStatus']);
        Route::post('/mark-spam', [QuestionController::class, 'markSpam']);
        Route::post('/reply', [AnswerController::class, 'store']);
        Route::get('/answers', [AnswerController::class, 'index']);
    });
});
