<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleClassController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');



Route::get('/instructor/dashboard', function () {
    return view('instructor.dashboard');
})->middleware(['auth', 'role:instructor'])->name('instructor.dashboard');

Route::resource('/instructor/schedule', ScheduleClassController::class)
    ->except(['edit', 'update', 'show'])
    ->middleware(['auth', 'role:instructor']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');


/* Member routes */
Route::middleware(['auth', 'role:member'])->prefix('/member')->group(function () {
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');

    Route::resource('/bookings', BookingController::class)->only(['create', 'store', 'index', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
