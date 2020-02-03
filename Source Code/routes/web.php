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

Route::view('demo','demo');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home'); 
//job


Route::get('/','JobController@index');
Route::get('/jobs/create','JobController@create')->name('job.create');
Route::post('/jobs/create','JobController@store')->name('job.store');
Route::get('/jobs/{id}/edit','JobController@edit')->name('job.edit');
Route::post('/jobs/{id}/edit','JobController@update')->name('job.update');
Route::get('/jobs/my-job','JobController@myjob')->name('my.job');
Route::get('/jobs/{id}/{job}', 'JobController@show')->name('jobs.show');

Route::post('/applications/{id}','JobController@apply')->name('apply');
Route::get('/jobs/applications','JobController@applicant')->name('applicant');
Route::get('/jobs/alljobs','JobController@allJobs')->name('alljobs');


//company
Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');
Route::get('/company/create','CompanyController@create')->name('company.view');
Route::post('/company/create','CompanyController@store')->name('company.store');
Route::post('/company/coverphoto','CompanyController@coverphoto')->name('cover.photo');
Route::post('/company/logo','CompanyController@companyLogo')->name('company.logo');

Route::get('companies','CompanyController@company')->name('company');


//user profile
Route::get('user/profile','UserController@index')->name('user.profile');
Route::post('user/profile/create','UserController@store')->name('profile.create');
Route::post('user/coverletter','UserController@coverletter')->name('cover.letter');
Route::post('user/resume','UserController@resume')->name('resume');
Route::post('user/avatar','UserController@avatar')->name('avatar');

//employer view
Route::view('employer/register','auth.employer-register')->name('employer.register');
Route::post('employer/register','EmployerRegisterController@employerRegister')->name('emp.register');

//category
Route::get('/category/{id}','CategoryController@index')->name('category.index');

//admin
Route::get('/dashboard','DashboardController@index')->middleware('admin');
Route::get('/dashboard/create','DashboardController@create')->middleware('admin');
Route::post('/dashboard/create','DashboardController@store')->name('post.store')->middleware('admin');
Route::post('/dashboard/destroy','DashboardController@destroy')->name('post.delete')->middleware('admin');
Route::get('/dashboard/{id}/edit','DashboardController@edit')->name('post.edit')->middleware('admin');
Route::post('/dashboard/{id}/update','DashboardController@update')->name('post.update')->middleware('admin');
Route::get('/dashboard/trash','DashboardController@trash')->middleware('admin');
Route::get('/dashboard/{id}/trash','DashboardController@restore')->name('post.restore')->middleware('admin');
Route::get('/posts/{id}/{slug}','DashboardController@show')->name('post.show');
Route::get('/dashboard/jobs','DashboardController@getAlljobs')->middleware('admin');
Route::get('/dashboard/{id}/jobs','DashboardController@changeJobStatus')->name('job.status')->middleware('admin');

