<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('Home');
});

Route::get('/admin/dashboard', function () {
    //echo "Route path Working";
    return view('admin.dashboard');
});

/*Route::get('/admin/categories', function () {
    //echo "Route path Working";
    return view('admin.category.index');
});

Route::get('/admin/categories/create', function () {
    //echo "Route path Working";
    return view('admin.category.create');
})->name('categories.create');
*/

/*
Route::get('/admin/categories',[CategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::get('/admin/categories/{id}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/admin/categories',[CategoryController::class, 'store'])->name('categories.store');
Route::put('/admin/categories/update/{id}',[CategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin/categories/destroy/{id}',[CategoryController::class, 'destroy'])->name('categories.destroy');

*/ 
//eta onnovabe likha jay
/*
Route::prefix('admin')->group(function(){

Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{id}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories',[CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/update/{id}',[CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}',[CategoryController::class, 'destroy'])->name('categories.destroy');
});
*/
//aro  easy  way te kora jay
Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('dashboard', function () {
        
        return view('admin.dashboard');
    })->name('admin.dashboard');
Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class);

    });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
