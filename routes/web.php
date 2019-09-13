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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profil', 'HomeController@profilUser')->name('profil_user');
Route::get('/edit_picture_user', 'HomeController@editPictureUser')->name('edit_picture_user');
Route::post('/upload-img', 'HomeController@uploadImg')->name('upload-img');
Route::get('/offre/{offre}', 'HomeController@viewOffre')->name('view_offre');
Route::get('/postuler/{offre}', 'HomeController@postuler')->name('postuler');
Route::get('/resilier_candidature/{candidature}', 'HomeController@resilierCandidature')->name('resilier_candaidature');

Route::prefix('admin')->group(function(){
	Route::name('admin.')->group(function () {
		Route::get('/', 'Auth\AdminLoginController@showLoginForm');
		Route::post('/', 'Auth\AdminLoginController@login')->name('login');
		Route::get('/welcome', 'AdminController@index')->name('index');
		Route::get('/offre', 'AdminController@showFormOffre')->name('show_form_offre');
		Route::post('/offre', 'AdminController@createOffre')->name('create_offre');
		Route::get('/offre/edit/{offre}', 'AdminController@editOffre')->name('edit_offre');
		Route::get('/offre/destroy/{offre}', 'AdminController@destroyOffre')->name('destroy_offre');
		Route::get('/offre/{offre}', 'AdminController@showOffre')->name('show_offre');

		Route::get('/accept_candidature/{candidature}', 'AdminController@acceptCandidature')->name('accept_candidature');

		Route::get('/profil/{user}', 'AdminController@profilUser')->name('profil_user');
Route::get('/resilier_candidature/{candidature}', 'AdminController@resilierCandidature')->name('resilier_candidature');



			


	});

		});



