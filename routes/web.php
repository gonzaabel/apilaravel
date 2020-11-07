<?php
use App\Http\Resources\User as UserResource;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/users', function () {
    return new UserResource(User::all());
});

Route::post('/users/create', function(Request $request){

	$rta = new UserResource(User::create($request->all()));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully created'}";
	}

	return "{msg: 'Error: User could not be created.'}";

});

Route::post('/users/update', function(Request $request){

	$rta = new UserResource(User::save($request->all()));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully updated'}";
	}

	return "{msg: 'Error: User could not be updated.'}";

});

Route::get('/users/delete/{id}', function($id){

	$rta = new UserResource(User::destroy($id));

	if(!empty($rta->resource)) {
		return "{msg: 'User succesfully deleted'}";
	}

	return "{msg: 'Error: User could not be deleted.'}";

});