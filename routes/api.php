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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


/*
 * Sample GET API : http://voucherpool.test/api/codes/lboyer@hotmail.com
 */
Route::get('/codes/{email}', [CodeController::class, 'listOfCodesByEmail']);

/*
 * Sample POST API : http://voucherpool.test/api/codeActivation?email=lboyer@hotmail.com&code=LHtzDTTv
 */

Route::post('/codeActivation/', [CodeController::class, 'codeActivationByEmailAndCode']);

/*
 * Sample POST API : http://voucherpool.test/api/codeGeneration?offer_name=Testing Offer 609&discount=59&expiry=19/01/2021
 */
Route::post('/codeGeneration/', [CodeController::class, 'codeGeneration']);
