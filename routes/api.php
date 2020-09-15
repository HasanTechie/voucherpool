<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;

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

/*
 * Sample GET API : http://voucherpool.test/api/codes/<email>>
 */
Route::get('/codes/{email}', [CodeController::class, 'listOfCodesByEmail']);

/*
 * Sample POST API : http://voucherpool.test/api/codes/generate?offer_name=<offer-name>&discount=<discount>&expiry=<expiry>
 */
Route::post('/codes/generate', [CodeController::class, 'codeGeneration']);

/*
 * Sample POST API : http://voucherpool.test/api/codes/activate/?email=<email>&code=<code>
 */
Route::post('/codes/activate', [CodeController::class, 'codeActivationByEmailAndCode']);


