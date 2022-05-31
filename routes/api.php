<?php
use Illuminate\Support\Facades\Route;


use App\User;

Route::group(['middleware' => ['guest:api']],function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:api']],function () {

    Route::post('logout', 'Auth\AuthController@logout');

    /**
     * User Management Routes
     */
    Route::get('/users', 'User\UserController@index')->middleware('permissionOrRole:admin');
    Route::post('/users/create', 'User\UserController@store');
    Route::get('/users/show/{id}', 'User\UserController@show');
    Route::post('/users/update/{id}', 'User\UserController@update');
    Route::post('/users/update/{field}/{id}', 'User\UserController@updateField');
    Route::get('/users/destroy/{id}', 'User\UserController@destroy');

    /**
     * Users ActivityLog Routes
     */
    Route::get('/users/activity/logs/{id}', 'User\ActivityLogController@index')->middleware('permissionOrRole:admin');


    Route::get('/sessions', 'Session\SessionController@index');
    Route::post('/sessions/store', 'Session\SessionController@store');
    Route::get('/sessions/show/{id}', 'Session\SessionController@show');
    Route::post('/sessions/update/{id}', 'Session\SessionController@update');
    Route::get('/sessions/destroy/{id}', 'Session\SessionController@destroy');

    Route::get('/sessions/terms/{session_id}', 'Term\TermController@index');
    Route::post('/sessions/terms/store/{session_id}', 'Term\TermController@store');
    Route::get('/sessions/terms/show/{term_id}', 'Term\TermController@show');
    Route::post('/sessions/terms/update/{term_id}', 'Term\TermController@update');
    Route::get('/sessions/terms/destroy/{term_id}', 'Term\TermController@destroy');

    Route::get('/classes', 'Clazz\ClazzController@index');
    Route::post('/classes/store', 'Clazz\ClazzController@store');
    Route::get('/classes/show/{id}', 'Clazz\ClazzController@show');
    Route::post('/classes/update/{id}', 'Clazz\ClazzController@update');
    Route::get('/classes/destroy/{id}', 'Clazz\ClazzController@destroy');

    Route::get('/students', 'Student\StudentController@index');
    Route::post('/students/store', 'Student\StudentController@store');
    Route::get('/students/show/{id}', 'Student\StudentController@show');
    Route::get('/students/destroy/{id}', 'Student\StudentController@destroy');
    Route::post('/students/update/{id}', 'Student\StudentController@update');

    Route::post('/class/registration', 'Clazz\ClassRegistrationController@store');


});
