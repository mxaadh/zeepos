<?php

use App\Http\Controllers\Auth\TenantLoginController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/tenant-ping', function () {
    return \DB::connection('tenant')->select('SELECT DB_NAME() AS db, @@SERVERNAME AS server');
});

Route::get('/', [ConnectController::class, 'index'])->name('connect.index');
Route::post('/connect', [ConnectController::class, 'connection'])->name('connect.connection');

Route::middleware(['tenant'])->group(function () {
    Route::get('/login', [TenantLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TenantLoginController::class, 'login'])->name('login.submit');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::middleware('auth')->group(function () {
//});

//
//Route::get('/', [InvoiceController::class, 'sales'])->name('invoice.sales');
//Route::get('/get-transaction-by-date', [InvoiceController::class, 'getTransactionByDate']);
//Route::get('/sales-details', [InvoiceController::class, 'getSalesDetails']);
//
//
////Route::get('/', function () {
////
////    return view('welcome');
////});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');
//});
//
//require __DIR__.'/auth.php';
//
//Auth::routes();
//
