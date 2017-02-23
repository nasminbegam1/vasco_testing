<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/',                           array('as' => 'user_login', 'uses' => 'UserController@login'));
Route::post('/login_action',              array('as' => 'user_login_action', 'uses' => 'UserController@login_action')); 
Route::get('/signup',                     array('as' => 'user_signup', 'uses' => 'UserController@signup'));
Route::post('/signup_action',             array('as' => 'user_signup_action', 'uses' => 'UserController@signup_action'));
Route::get('/signup_success',             array('as' => 'user_signup_success', 'uses' => 'UserController@signup_success'));
Route::get('/email_verification/{vcode}', array('as' => 'email_verification', 'uses' => 'UserController@email_verification'));
Route::post('/emailExist',                array('as' => 'emailExist', 'uses' => 'UserController@emailExist'));
Route::get('/forgot-password',            array('as' => 'forgot_password', 'uses' => 'UserController@forgot_password'));
Route::post('/forgot_password_action',    array('as' => 'forgot_password_action', 'uses' => 'UserController@forgot_password_action'));
Route::get('/reset-password/{token}',     array('as' => 'reset_password', 'uses' => 'UserController@reset_password'));
Route::post('/reset_password_action',     array('as' => 'reset_password_action', 'uses' => 'UserController@reset_password_action'));
Route::get('/logout',                     array('as' => 'logout', 'uses' => 'UserController@logout'));
Route::get('/success',                    array('as' => 'success', 'uses' => 'UserController@success'));
Route::any('/get_city',                   array('as' => 'get_city', 'uses' => 'UserController@get_city'));
Route::any('/resend_verify_code/{vemail}',         array('as' => 'resend_verify_code', 'uses' => 'UserController@get_verify_code'));



Route::group(array('middleware' => 'patient'), function(){
Route::get('/dashboard',                    array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

Route::post('/add_medication',               array('as' => 'add_medication', 'uses' => 'DashboardController@add_medication'));

Route::post('/remove_record',               array('as' => 'remove_record', 'uses' => 'DashboardController@destroy_record'));

Route::get('/edit_profile',                    array('as' => 'edit_profile', 'uses' => 'UserController@edit_profile'));

Route::post('/user_edit_action',             array('as' => 'user_edit_action', 'uses' => 'UserController@user_edit'));

Route::get('/billing_details',                    array('as' => 'edit_billing', 'uses' => 'BillingController@edit_billing'));
Route::post('/update_billing',                    array('as' => 'update_billing', 'uses' => 'BillingController@update_billing'));

Route::get('/change_password',                    array('as' => 'change_password', 'uses' => 'UserPasswordController@index'));
Route::post('/password_change_action',             array('as' => 'password_change_action', 'uses' => 'UserPasswordController@do_password_change'));

Route::post('/edit_easy_open_cap',                    array('as' => 'edit_easy_open_cap', 'uses' => 'DashboardController@update_easy_open_cap'));

Route::post('/edit_prescription_filled',              array('as' => 'edit_prescription_filled', 'uses' => 'DashboardController@update_prescription_filled'));

});
//Route::get('/', function () {
//    return view('welcome');
//});
