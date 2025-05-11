<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\DesignerProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [HomeController::class, 'landingPage'])->name('landing');

// Product routes with model binding
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Newsletter subscription
Route::post('/newsletter', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Authentication routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Favorites routes
    Route::middleware(['auth'])->group(function () {
        // Favorites routes
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
        Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');
        Route::post('/favorites/add-all-to-cart', [FavoriteController::class, 'addAllToCart'])->name('favorites.add-all-to-cart');
        
        // Ratings routes
        Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    });
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    // Ratings routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    
    // Designer Profile Interaction Routes (require authentication)
    Route::post('/designers/{designer}/products/{product}/customize', 
        [DesignerProfileController::class, 'submitCustomization'])
        ->name('designers.products.customize');
    
    // Course Enrollment Route
    Route::post('/designers/{designer}/courses/{course}/enroll', 
        [DesignerProfileController::class, 'enrollCourse'])
        ->name('designers.courses.enroll');
    
    // Event RSVP Route
    Route::post('/designers/{designer}/events/{event}/rsvp', 
        [DesignerProfileController::class, 'rsvpEvent'])
        ->name('designers.events.rsvp');
});

// Course routes with model binding
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{course}/enroll', [EnrollmentController::class, 'create'])
    ->name('courses.enrollments.create');

    

// حفظ بيانات التسجيل في الدورة
Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])
    ->name('courses.enrollments.store');

// صفحة تأكيد أو عرض حالة التسجيل إن أردت (اختياري)
Route::get('/courses/{course}/enrolled', [EnrollmentController::class, 'enrolled'])
    ->name('courses.enrolled');

// Designer routes with model binding
Route::get('/designers', [DesignerController::class, 'index'])->name('designers.index');
Route::get('/designers/{user}', [DesignerController::class, 'show'])->name('designers.show');

// Designer Profile Route (accessible to everyone)
Route::get('/designers/{designer}/profile', [DesignerProfileController::class, 'show'])
    ->name('designers.profile');

// Cart routes that don't require authentication
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// About and contact pages
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', function() {
    return view('contact');
})->name('contact');
Route::get('/blog', function() {
    return view('blog');
})->name('blog');

// Dashboard route provided by Laravel Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Include the authentication routes
require __DIR__.'/auth.php';