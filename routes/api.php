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

Route::middleware('auth:api')->get('/users', function () {
    return new UserResource(User::all());
});

Route::middleware('auth:api')->post('/users/create', function(Request $request){

	$rta = new UserResource(User::create($request->all()));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully created'}";
	}

	return "{msg: 'Error: User could not be created.'}";

});

Route::middleware('auth:api')->post('/users/update', function(Request $request){

	$rta = new UserResource(User::save($request->all()));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully updated'}";
	}

	return "{msg: 'Error: User could not be updated.'}";

});

Route::middleware('auth:api')->get('/users/delete/{id}', function($id){

	$rta = new UserResource(User::destroy($id));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully deleted'}";
	}

	return "{msg: 'Error: User could not be deleted.'}";

});