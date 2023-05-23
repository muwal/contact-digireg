<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressBookController;

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

Route::post('/create', [AddressBookController::class, 'add_contact']);
Route::delete('/delete/{name?}', [AddressBookController::class, 'remove_contact']);
Route::get('/search/{name?}', [AddressBookController::class, 'search_contact']);
