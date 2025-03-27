<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\BusController;

//  Public Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contactus', 'submit')->name('contact.submit');
    Route::get('/blog', 'blog')->name('blog');
});
Route::get('/bus/search', [BusController::class, 'search'])->name('search.buses');


//  User Dashboard (Only Authenticated Users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes (Authenticated Users Only)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  Bus Search and Filters (Public)
Route::get('/buses/filter', [BusController::class, 'filter'])->name('bus.filter');

//  Bus Seat Viewing
Route::get('/view-seats/{id}', [BusController::class, 'viewSeats'])->name('view.seats');
Route::get('/passenger-details', [BusController::class, 'passengerDetails'])->name('passenger.details');
});

require __DIR__ . '/auth.php';

//  Admin Routes (Protected by Admin Middleware)
Route::middleware(['auth', 'Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Cities Management
    Route::prefix('cities')->group(function () {
        Route::get('/', [AdminCityController::class, 'index'])->name('admin.cities.index');
        Route::get('/create', [AdminCityController::class, 'create'])->name('admin.cities.create');
        Route::post('/', [AdminCityController::class, 'store'])->name('admin.cities.store');
        Route::get('/{id}/edit', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
        Route::put('/{id}', [AdminCityController::class, 'update'])->name('admin.cities.update');
        Route::delete('/{id}', [AdminCityController::class, 'destroy'])->name('admin.cities.destroy');
    });

    // Buses Management
    Route::prefix('buses')->group(function () {
        Route::get('/', [BusController::class, 'index'])->name('admin.buses.index');
        Route::get('/create', [BusController::class, 'create'])->name('admin.buses.create');
        Route::post('/', [BusController::class, 'store'])->name('admin.buses.store');
        Route::get('/{id}/edit', [BusController::class, 'edit'])->name('admin.buses.edit');
        Route::put('/{id}', [BusController::class, 'update'])->name('admin.buses.update');
        Route::delete('/{id}', [BusController::class, 'destroy'])->name('admin.buses.destroy');
    });
});

//  Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});



use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
