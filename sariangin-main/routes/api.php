<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AJAX
Route::group(
    [
        'prefix' => 'ajax',
        'as' => 'ajax.',
        'middleware' => ['auth:web']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'users',
                'as' => 'users.',
            ],
            function () {
                Route::get('', [UserController::class, 'index'])
                    ->name('index');
            }
        );
    }
);
