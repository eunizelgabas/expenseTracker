<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;

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
    return inertia('welcome');
});
Route::get('/login', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);

Route::get('/register', [SiteController::class, 'registerForm'])->name('register');
Route::post('/register',[SiteController::class, 'register']);

Route::group(['middleware'=>'auth'], function(){

    Route::post('/logout', [SiteController::class, 'logout']);

    Route::get('/budget', [BudgetController::class,'index'])->name('budgets');
    Route::get('/budget/create', [BudgetController::class,'create']);
    Route::post('/budget',[BudgetController::class, 'store']);
    Route::get('/budget/edit/{budget}', [BudgetController::class, 'edit']);
    Route::put('/budget/{budget}', [BudgetController::class, 'update']);
    Route::delete('/budget/{budget}', [BudgetController::class, 'destroy']);

    Route::get('/category', [CategoryController::class,'index'])->name('categories');
    Route::get('/category/create', [CategoryController::class,'create']);
    Route::post('/category',[CategoryController::class, 'store']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);
    Route::delete('/category/{category}', [CategoryController::class, 'destroy']);

    Route::get('/expenses', [ExpensesController::class,'index'])->name('expenses');
    Route::get('/expenses/create', [ExpensesController::class,'create']);
    Route::post('/expenses',[ExpensesController::class, 'store']);
    Route::get('/expenses/edit/{expenses}', [ExpensesController::class, 'edit']);
    Route::put('/expenses/{expenses}', [ExpensesController::class, 'update']);
    Route::delete('/expenses/{expenses}', [ExpensesController::class, 'destroy']);
    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
