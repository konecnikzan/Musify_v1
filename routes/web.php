<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/social-login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-login.redirect');
Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social-login.callback');

Route::get('/profile/{id}', 'ProfileController@show_profile')->name('profile');

Route::get('/chat/{id}', 'MessagesController@index')->name('chat');
//Route::post('message', 'MessagesController@sendMessage');

Route::get('/contacts', 'ContactsController@get');
Route::get('/contact/{id}', 'ContactsController@getContactInfo');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');
Route::post('/conversation_update/{id}', 'ContactsController@updateConvo');




