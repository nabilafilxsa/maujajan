<?php

use App\Http\Controllers\ProfileController; // ambil profilcontroller
use App\Http\Controllers\FoodController; // class route
use App\Http\Controllers\OrderController; // ambil foodcontroller
use Illuminate\Support\Facades\Route; // ambil OrderController

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES (Publik)
|--------------------------------------------------------------------------
| Halaman katalog menu & proses checkout pesanan pelanggan.
*/
Route::get('/', [OrderController::class, 'index'])->name('customer.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('customer.checkout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Wajib Login)
|--------------------------------------------------------------------------
| Dashboard Breeze langsung diarahkan ke rekap pesanan admin.
*/
Route::get('/dashboard', [OrderController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // ============ Profile (Breeze) ============
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============ Admin Dashboard & Update Status Pesanan ============
    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])
        ->name('admin.dashboard');
    // Update status pesanan (pending/diproses/selesai)
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');

    // ============ CRUD Makanan ============
    //Route::resource otomatis generate 7 route crud:
    // index, create, store, show, edit, update, destroy
    Route::resource('/admin/foods', FoodController::class);
});

   //panggil route autentikasi dari breeze (login, register, dll)
require __DIR__.'/auth.php';