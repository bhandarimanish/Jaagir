<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//jobs
 Route::get('/','JobController@index');
 Route::get('/jobs/create','JobController@create')->name('job.create');
 Route::post('/jobs/create','JobController@store')->name('job.store');
 Route::get('/jobs/{id}/edit','JobController@edit')->name('job.edit');
 Route::post('/jobs/{id}/edit','JobController@update')->name('job.update');
 Route::get('jobs/my-job','JobController@myjob')->name('job.mine');
 Route::get('jobs/applications','JobController@applicant')->name('job.applicant');
 Route::get('jobs/alljobs','JobController@allJobs')->name('job.all');

 Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/jobs/{id}/{job}','JobController@show')->name('jobs.show');

//company
Route::get('/company/{id}/{company}','CompanyController@index')->name('company.index');
Route::get('company/create','CompanyController@create')->name('company.profile');
Route::post('company/create','CompanyController@store')->name('company.store');
Route::post('company/coverphoto','CompanyController@coverphoto')->name('cover.photo');
Route::post('company/logo','CompanyController@logo')->name('company.logo');


//user profile
Route::get('user/profile','UserController@index')->name('user.profile');
Route::post('user/profile/create','UserController@store')->name('profile.create');
Route::post('user/coverletter','UserController@coverletter')->name('cover.letter');
Route::post('user/resumeletter','UserController@resumeletter')->name('resume');
Route::post('user/avatar','UserController@avatar')->name('avatar');

//employer
Route::view('employer/register','auth.employer-register')->name('employer.register');
Route::post('employer/register','EmployerRegisterController@employerRegister')->name('emp.register');
 Route::post('applications/{id}','JobController@apply')->name('apply');


//save and unsave jobs
Route::post('/save/{id}','FavouriteController@saveJob');
Route::post('/unsave/{id}','FavouriteController@unSaveJob');

//Search
Route::get('/jobs/search','JobController@searchJobs');

//category
Route::get('/category/{id}/jobs','CategoryController@index')->name('category.index');

//company
Route::get('/companies','CompanyController@company')->name('company');

//email
Route::post('/job/mail','EmailController@send')->name('mail');

//admin
Route::get('/dashboard','DashboardController@index')->middleware('admin');
