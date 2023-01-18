<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAccessToken;
use App\Http\Controllers\Api\V1\CardController;
use App\Http\Controllers\Api\V1\ColumnController;
use App\Http\Controllers\Api\V1\ColumnCardController;

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


Route::post('v1/auth/register', [AuthController::class, 'createUser']);
Route::post('v1/auth/login', [AuthController::class, 'loginUser']);

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});
// Route::middleware(['auth:sanctum', CheckAccessToken::class])
//Route::middleware([CheckAccessToken::class])
Route::prefix('v1')
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::controller(CardController::class)
            ->group(function () {
                Route::get('cards', 'index')->middleware([CheckAccessToken::class]);
            });
        Route::controller(ColumnController::class)
            ->prefix('columns')
            ->group(function () {
                Route::get('/', 'index');
                Route::delete('{column}', 'destroy');
                Route::post('/', 'store');
            });
        Route::controller(ColumnCardController::class)
            ->prefix('columns')
            ->group(function () {
                Route::get('{column}/cards', 'index');
                Route::post('{column}/cards', 'store');
            });
    });
