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

Route::get('/', function () {
  return redirect('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('assessments', 'AssessmentController');

//Food catalog in Json format
//Route::get('foods/catalog',array('as'=>'catalog','uses'=>'FoodController@catalog'));

Route::resource('foods', 'FoodController');

Route::resource('habits', 'HabitController');

Route::resource('illnesses', 'IllnessController');

Route::resource('medications', 'MedicationController');

Route::resource('patients', 'PatientController');

Route::resource('roles', 'RoleController');

Route::resource('supplements', 'SupplementController');

Route::resource('visits', 'VisitController');

Route::resource('malaises', 'MalaiseController');

Route::resource('recommendations', 'RecommendationController');

Route::resource('tests', 'TestController');

Route::resource('relationships', 'RelationshipController');





