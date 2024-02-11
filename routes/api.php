<?php

use App\Http\Controllers\API\{
    LessonController,
    LoginController,
    RelationshipController,
    UserController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('users', UserController::class);
    
    Route::controller(RelationshipController::class)->group(function () {
        Route::get('/users/{id}/lessons', 'userLessons');
        Route::get('/lessons/{id}/tags', 'lessonTags');
        Route::get('/tags/{id}/lessons', 'tagLessons');
    });

    Route::any('/lesson', function () {
        $message = "Please make sure to update your code to use the newer version of our API.
        You should use lessons instead of lesson";
        return Response::json([
            'data' => $message,
            'url' => url('documentation/api')
        ], 404);
    });

    Route::get('/login', [LoginController::class, 'login'])->name('login');
});
