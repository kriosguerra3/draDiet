<?php

use Illuminate\Http\Request;

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


Route::resource('assessments', 'AssessmentAPIController');

Route::resource('exercises', 'ExerciseAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('habits', 'HabitAPIController');

Route::resource('illnesses', 'IllnessAPIController');

Route::resource('medications', 'MedicationAPIController');

Route::resource('patients', 'PatientAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('schedules', 'ScheduleAPIController');

Route::resource('supplements', 'SupplementAPIController');