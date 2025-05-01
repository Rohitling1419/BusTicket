<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\KhaltiPaymentController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contactus', 'submit')->name('contact.submit');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{id}', 'showBlog')->name('blog.show');

});

// ✅ Bus Search (Public)
Route::get('/bus/search', [PageController::class, 'search'])->name('search.buses');

/*
|--------------------------------------------------------------------------
| Guest Routes (Register, Login, Forgot Password)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Users (User Dashboard, Profile, Bookings)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/buses/filter', [BusController::class, 'filter'])->name('bus.filter');
    Route::get('/view-seats/{id}', [PageController::class, 'viewSeats'])->name('view.seats');
    Route::get('/passenger-details', [PageController::class, 'passengerDetails'])->name('passenger.details');

    // ✅ User Booking History & Cancel
    Route::get('/bookings/history', [BookingController::class, 'userBookingHistory'])->name('user.booking.history');
    Route::post('/bookings/submit', [BookingController::class, 'bookingsubmit'])->name('booking.submit');
// Route for canceling a booking
Route::put('booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected with Middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'Admin'])->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    // Cities Management
    Route::prefix('cities')->name('cities.')->group(function () {
        Route::get('/', [AdminCityController::class, 'index'])->name('index');
        Route::get('/create', [AdminCityController::class, 'create'])->name('create');
        Route::post('/', [AdminCityController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminCityController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminCityController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminCityController::class, 'destroy'])->name('destroy');
    });

    // Buses Management
    Route::prefix('buses')->name('buses.')->group(function () {
        Route::get('/', [BusController::class, 'index'])->name('index');
        Route::get('/create', [BusController::class, 'create'])->name('create');
        Route::post('/', [BusController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BusController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BusController::class, 'update'])->name('update');
        Route::delete('/{id}', [BusController::class, 'destroy'])->name('destroy');
    });

    // Booking History (Admin View)
    Route::get('/booking-history', [BookingController::class, 'history'])->name('bookingHistory');


    // Blog Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    });
});
Route::get('/booking-history', [BookingController::class, 'history'])->name('bookingHistory');


/*
|--------------------------------------------------------------------------
| Admin Auth Routes (Login, Logout)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Laravel Breeze Auth Scaffolding
|--------------------------------------------------------------------------
*/
Route::post('/khalti/purchase', [KhaltiPaymentController::class, 'purchase'])->name('khalti.purchase');
Route::get('/verify-payment', function () {
    return view('frontend.payment.success');
});
Route::post('/khalti/verify', [KhaltiPaymentController::class, 'verifyPayment'])->name('khalti.verify');
require __DIR__ . '/auth.php';


