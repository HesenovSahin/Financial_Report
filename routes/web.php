<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;



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
    return view('auth.login');
});

Route::get('/home', function () {
        return view('backend/pages/index');
})->name('home.page');

Route::resource('user',UserController::class);
Route::resource('revenue',RevenueController::class);
Route::resource('expense',ExpenseController::class);
Route::resource('category',CategoryController::class);

//excel export
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/expenses/export', [ReportController::class, 'exportExpenses'])->name('expenses.export');
Route::get('/revenues/export', [ReportController::class, 'exportRevenues'])->name('revenues.export');


//expenses view and download pdf
Route::get('/expenses/view-pdf', [ReportController::class, 'viewExpensesPdf'])->name('expense.viewpdf');
Route::get('/expenses/download-pdf', [ReportController::class, 'downloadExpensesPdf'])->name('expense.downloadpdf');
//revenues view and download pdf
Route::get('/revenues/view-pdf', [ReportController::class, 'viewRevenuesPdf'])->name('revenues.viewpdf');
Route::get('/revenues/download-pdf', [ReportController::class, 'downloadRevenuesPdf'])->name('revenues.downloadpdf');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
