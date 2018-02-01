<?php

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


// Route::get('/', function () {
//    return view('welcome');
// });

// Route::get('ID/{id}',function($id){
// 	echo 'ID: '.$id;
// });

// Route::get('/user/{name?}',function($name = 'Virat Gandhi') {
// 	echo "Name: ".$name;
// });


/**
	

	*Display all tasks
*/

use firstone\Task;
use Illuminate\Http\Request;
Route::get('/',function(){
	$tasks = Task::orderBy('created_at','asc')->get();
	return view('layouts.tasks', [
		'tasks' => $tasks
	]);
});

/**
	*Add a new task

*/
Route::post('/task',function(Request $request){
	$validator = Validator::make($request->all(), [
		'name'=>'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	//  Create The task
	$task = new Task;
	$task->name = $request->name;
	$task->save();

	return redirect('/');
});


Route::delete('/task/{id}', function($id){
	Task::findOrFail($id)->delete();

	return redirect('/');
});

