<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Development methods */
if (in_array(App::environment(),array('local','test'))) {
    // Get env
    Route::get('env', function () {
        return App::environment().'@'.gethostname();
    });
    // Get client ip
    Route::get('/client',function(){
        return $_SERVER['REMOTE_ADDR'];
    });
}

/* Login / logout routes */
Route::get('/login', array('uses' => 'SessionController@showLogin'));
Route::post('/login', array('uses' => 'SessionController@doLogin'));
Route::get('/logout', array('uses' => 'SessionController@doLogout'));

/* Admin routes */
Route::group(array('before'=>'auth','prefix'=>'admin'),function(){
    /* Admin backend */
    Route::controller('/', 'AdminController');
});

/* Api routes */
Route::group(array('before'=>'auth','prefix'=>'api'), function(){
    /* Resource routes */
    Route::resource('resource', 'ResourceController');
});

/* Public index */
Route::controller('/', 'PublicController');

