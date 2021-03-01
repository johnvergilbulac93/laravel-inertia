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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth' ], function () {
    
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/leads/add', [App\Http\Controllers\LeadController::class, 'create'])->name('lead.add');
      
    Route::post('/leads/save', [App\Http\Controllers\LeadController::class, 'store']);
    Route::get('/leads/list', [App\Http\Controllers\LeadController::class, 'index'])->name('lead.list');
    Route::get('/leads/view/{lead}', [App\Http\Controllers\LeadController::class, 'view'])->name('lead.view');  
    Route::post('/leads/update', [App\Http\Controllers\LeadController::class, 'update'])->name('lead.update');  

    Route::get('/leads/view/{lead}/reminder/add', [App\Http\Controllers\ReminderController::class, 'add'])->name('reminder.add');  
    Route::post('/leads/view/reminder/save', [App\Http\Controllers\ReminderController::class, 'store'])->name('reminder.save');  
    Route::get('/leads/view/{lead}/reminder/{reminder}/view', [App\Http\Controllers\ReminderController::class, 'view'])->name('reminder.view');  
    Route::get('/leads/view/{lead}/reminder/{reminder}/note', [App\Http\Controllers\ReminderController::class, 'note'])->name('reminder.note');  
    Route::post('/leads/view/reminder/close', [App\Http\Controllers\ReminderController::class, 'close'])->name('reminder.close');  

    Route::get('/package/list', [App\Http\Controllers\PackageController::class, 'index'])->name('package.list');  
    Route::post('/package/save', [App\Http\Controllers\PackageController::class, 'store'])->name('package.save');  
    Route::get('/package/view/{package}', [App\Http\Controllers\PackageController::class, 'view'])->name('package.view');  
    Route::post('/package/update', [App\Http\Controllers\PackageController::class, 'update'])->name('package.update');
    Route::delete('/package/list/{package}', [App\Http\Controllers\PackageController::class, 'destroy'])->name('package.delete');  


});
