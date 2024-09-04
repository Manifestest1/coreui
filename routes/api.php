<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AdminController;

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
    Route::post('/login-superadmin', [AuthController::class, 'loginForSuperadmin']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/create-profile', [AuthController::class, 'createProfile']);
    Route::post('/update-employee-profile', [AuthController::class, 'updateEmployeeProfile']);
    Route::post('/update-employer-profile', [AuthController::class, 'updateEmployerProfile']);
    Route::get('/public-profile-employee/{id}', [AuthController::class, 'emplyeePublicProfile']);

    // Route::get('/get-country', [AuthController::class, 'getCountries']);
    // Route::get('/get-state/{countryId}', [AuthController::class, 'getStates']);
    // Route::get('/get-city/{id}', [AuthController::class, 'getCity']);


    // Job Url
    Route::post('/create-jobpost', [JobController::class, 'createJob']);
    Route::get('/job-get-employee', [JobController::class, 'getEmployeeJob']);
    Route::post('/job-search-employer', [JobController::class, 'searchEmployerJob']);
    Route::get('/job-view/{id}', [JobController::class, 'jobViewOnEmployee']);
    Route::get('/job-apply/{id}', [JobController::class, 'jobApplyOnEmployee']);
    Route::get('/job-get-employer', [JobController::class, 'getJobEmployer']);
    Route::get('/job-view-employer/{id}', [JobController::class, 'jobViewOnEmployer']);
    Route::get('/fav-job-employee/{id}',[JobController::class,'favJobEmployee']);

    Route::get('/employee-fav-job ',[JobController::class,'EmployeeFavJob']);
    Route::get('/get-employee',[JobController::class,'getEmployee']);

    // Route::post('/send-email', [ContactController::class, 'sendMail']);
    Route::post('/contact-mail-send', [ContactController::class, 'contactSendMail']);
    Route::get('employee-download-pdf/{id}', [AuthController::class, 'generatepdf']);
});

Route::prefix('admin')->group(function () {
    Route::post('login', [AdminController::class, 'login']);
    Route::get('profile', [AdminController::class, 'adminProfile']);
    Route::get('users-list', [AdminController::class, 'getUsersList']);
    Route::get('users-delete/{id}', [AdminController::class, 'userDelete']);
    Route::post('/users-update/{id}', [AdminController::class, 'updateUser']);
    Route::post('/users-edit/{id}', [AdminController::class, 'editUser']);
    Route::post('logout', [AdminController::class, 'logout']);
});