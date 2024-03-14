<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;  

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great! 
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) 
{
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']); 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);   
    Route::post('/create-profile', [AuthController::class, 'createProfile']);
    Route::get('/public-profile-employee/{id}', [AuthController::class, 'publicProfileOfEmployee']);  

    // Job Url
    Route::post('/create-jobpost', [JobController::class, 'createJobPost']);
    Route::get('/job-get-employee', [JobController::class, 'jobGetonEmployee']); 
    Route::post('/job-search-employer', [JobController::class, 'jobSearchEmployer']); 
    Route::get('/job-view/{id}', [JobController::class, 'jobViewOnEmployee']);    
    Route::get('/job-apply/{id}', [JobController::class, 'jobApplyOnEmployee']);  
    Route::get('/job-get-employer', [JobController::class, 'jobGetonEmployer']);
    Route::get('/job-view-employer/{id}', [JobController::class, 'jobViewOnEmployer']);     
      
});
