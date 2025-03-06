<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;


// Public Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact'); // Handles GET requests
    Route::post('/contactus', 'submit')->name('contact.submit'); // Handles POST requests
    Route::get('/blog', 'blog')->name('blog');
});

// User Dashboard (Only Authenticated Users)
Route::get('/dashboard', function () {
    return \view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Only Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ✅ Admin Routes (Using Admin Middleware)
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\BusController;


Route::prefix('admin')->group(function () {
    // Cities Routes
    Route::get('/cities', [AdminCityController::class, 'index'])->name('admin.cities.index');
    Route::get('/cities/create', [AdminCityController::class, 'create'])->name('admin.cities.create');
    Route::post('/cities', [AdminCityController::class, 'store'])->name('admin.cities.store');
    Route::get('/cities/{id}/edit', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
    Route::put('/cities/{id}', [AdminCityController::class, 'update'])->name('admin.cities.update');
    Route::delete('/cities/{id}', [AdminCityController::class, 'destroy'])->name('admin.cities.destroy');

    // Buses Routes
    Route::get('/buses', [BusController::class, 'index'])->name('admin.buses.index');
    Route::get('/buses/create', [BusController::class, 'create'])->name('admin.buses.create');
    Route::post('/buses', [BusController::class, 'store'])->name('admin.buses.store');
    Route::get('/buses/{id}/edit', [BusController::class, 'edit'])->name('admin.buses.edit');
    Route::put('/buses/{id}', [BusController::class, 'update'])->name('admin.buses.update');
    Route::delete('/buses/{id}', [BusController::class, 'destroy'])->name('admin.buses.destroy');
});

// Search Route
Route::get('/search-buses', [BusController::class, 'search'])->name('search.buses');

