<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return new UserResource(User::all());
});

Route::post('/users/create', function(Request $request){

	$user = User::create($request->all());

	if(!empty($user)) {
		return new UserResource($user->fresh());
	}

	throw new InternalErrorException("User could not be created.");

});

Route::put('/users/update', function(Request $request){

	$rta = new UserResource(User::where('id', $request->id)->update($request->all()));

	if(!empty($rta->resource)) {
		return "{}";
	}

	throw new InternalErrorException("User could not be updated.");

});

Route::delete('/users/delete/', function(Request $request){

	$rta = new UserResource(User::destroy($request->id));

	if(!empty($rta->resource)) {
		return "{}";
	}

	throw new InternalErrorException("User could not be deleted.");

});