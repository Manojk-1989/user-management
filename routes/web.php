<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $colors = Color::get();
//     $sizes = Size::get();
//     $page = 'product';
//     $pageTitle = 'Add Product';
//     return view('pages.user',compact('page', 'pageTitle', 'colors', 'sizes'));
// });

Route::get('/user', [UserController::class, 'create'])->name('user.create');
Route::get('/user-lists', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{encriptedId}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/view-user/{id}', [UserController::class, 'show'])->name('user.show');



Route::get('/department', [DepartmentController::class, 'create'])->name('department.create');
Route::get('/department-lists', [DepartmentController::class, 'index'])->name('department.index');
Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/edit-department/{encriptedId}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::delete('/delete-department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
Route::put('/update-department/{id}', [DepartmentController::class, 'update'])->name('department.update');

Route::get('/designation', [DesignationController::class, 'create'])->name('designation.create');
Route::get('/designation-lists', [DesignationController::class, 'index'])->name('designation.index');
Route::post('/designation', [DesignationController::class, 'store'])->name('designation.store');
Route::get('/edit-designation/{encriptedId}', [DesignationController::class, 'edit'])->name('designation.edit');
Route::delete('/delete-designation/{id}', [DesignationController::class, 'destroy'])->name('designation.destroy');
Route::put('/update-designation/{id}', [DesignationController::class, 'update'])->name('designation.update');

Route::get('/user-search', [UserSearchController::class, 'create'])->name('user-search.create');
Route::get('/user-cards', [UserSearchController::class, 'index'])->name('user-search.index');



