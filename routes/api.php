<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\PdfController;
use App\Http\Controllers\Api\ProfileController;

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
    Route::post('/refresh-token', [AuthController::class, 'refresh']);

    Route::get('/user-profile', [ProfileController::class, 'userProfile']);
    Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
    Route::post('/create-profile', [ProfileController::class, 'createProfile']);
    Route::post('/update-employee-profile', [ProfileController::class, 'updateEmployeeProfile']);
    Route::post('/update-employer-profile', [ProfileController::class, 'updateEmployerProfile']);
    Route::get('/public-profile-employee/{id}', [ProfileController::class, 'emplyeePublicProfile']);


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

    Route::get('/employee-download-pdf/{id}', [PdfController::class, 'generatepdf']);
});

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/profile', [AdminController::class, 'adminProfile']);
    Route::get('/users-list', [AdminController::class, 'getUsersList']);
    Route::get('/users-delete/{id}', [AdminController::class, 'userDelete']);
    Route::post('/users-update/{id}', [AdminController::class, 'updateUser']);
    Route::post('/users-edit/{id}', [AdminController::class, 'editUser']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::get('/meta-tags', [AdminController::class, 'showMetaTag']);
    Route::post('/meta-tags-add', [AdminController::class, 'metaTagAdd']);
    Route::get('/meta-tags-edit/{id}', [AdminController::class, 'metaTagEdit']);
    Route::post('/meta-tags-update/{id}', [AdminController::class, 'metaTagUpdate']);
    Route::delete('/meta-tags-delete/{id}', [AdminController::class, 'metaTagDelete']);
});