<?php

use App\Http\Controllers\ContactController;
use App\Models\Contact;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/contacts/index', [ContactController::class, 'index']);

Route::get('/contacts/show/{id}', [ContactController::class, 'show']);

Route::post('/contacts/store', [ContactController::class, 'store']);

Route::patch('/contacts/update/{contact_id}', [ContactController::class, 'update']);

Route::delete('/contacts/destroy/{id}', [ContactController::class, 'destroy']);
