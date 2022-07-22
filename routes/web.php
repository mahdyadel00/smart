<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Portal\Controllers\AboutUsController;
use App\Modules\Portal\Controllers\LoginController;
use App\Modules\Portal\Controllers\ContactController;
use App\Modules\Portal\Controllers\QuizController;
use App\Modules\Portal\Controllers\ContentController;
use App\Modules\Portal\Controllers\ContentModuleController;

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

/*-----------------  site routes -----------------*/

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/do-login', [LoginController::class, 'store'])->name('login.check');

Route::get('/logout' , [LoginController::class , 'logout'])->name('logout');
Route::get('/my-profile' , [LoginController::class , 'myProfile'])->name('my_profile');
Route::post('/my-profile/{id}/edit' , [LoginController::class , 'edit'])->name('profile.edit');

Route::get('/', \App\Modules\Portal\Controllers\HomeController::class . '@index')->name('home');
Route::get('/lang/{locale?}', \App\Modules\Portal\Controllers\HomeController::class . '@changeHomeLang')->name('change_language');
Route::get('blog/categories', \App\Modules\Portal\Controllers\BlogController::class . '@categories')->name('allcategory');
Route::post('/group-user', \App\Modules\Portal\Controllers\HomeController::class . '@addUserGroup')->name('userGroup');

Route::get('contact-us', [ContactController::class, 'contact_us'])->name('contact');
Route::post('contact-us', [ContactController::class, 'contactSave'])->name('contact.post');


    Route::get('quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('quiz/store', [QuizController::class, 'store'])->name('quiz.store');

    //content
    Route::get('content/{id}', [ContentController::class, 'index'])->name('content.index');

    Route::get('content_modules', [ContentModuleController::class, 'index'])->name('content_modules.index');

Route::middleware(['throttle:2,1'])->group(function () {
    Route::post('/job/uploadFile', \App\Modules\Portal\Controllers\JobsController::class . '@uploadFile')->name('upload.file.job');
});

Route::view('/about', [AboutUsController::class, 'index'])->name('aboutus');

Route::get('/file-upload', [ContentController::class, 'fileUpload'])->name('file.upload');
Route::post('/file-upload', [ContentController::class, 'fileUploadPost'])->name('file.upload.post');
