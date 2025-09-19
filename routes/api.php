<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and are automatically
| assigned the "api" middleware group. All routes here will be prefixed with /api.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('borrowings', BorrowingController::class);
Route::post('/borrow/{book}', [BorrowingController::class, 'borrow']);
Route::post('/return/{book}', [BorrowingController::class, 'returnBook']);

Route::apiResource('books', BookController::class);
