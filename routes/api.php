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
 * Sample POST API : http://voucherpool.test/api/code/generate?offer_name=<offer-name>&discount=<discount>&expiry=<expiry>
 */
Route::post('/code/generate', [CodeController::class, 'codeGeneration']);

/*
 * Sample POST API : http://voucherpool.test/api/code/activate/?email=<email>&code=<code>
 */
Route::post('/code/activate', [CodeController::class, 'codeActivationByEmailAndCode']);


