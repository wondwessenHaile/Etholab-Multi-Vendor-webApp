<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\adminController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin group route
route::prefix('admin/')->namespace('Admin')->group(function(){
//login route
Route::match(['get','post'],'login', [AdminController::class, 'login'])->name('admin.login');
Route::group(['middleware'=>['admin']],function() {
    //addmin route to dashboard
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    

});


});
