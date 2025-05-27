<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DesignerController;

use App\Http\Controllers\Designer\DesignerSettings;
use App\Http\Controllers\DesignerProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\CoursesAdminController;
use App\Http\Controllers\Admin\CouponAdminController;



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

    // معالجة الـ checkout
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

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

// routes/web.php

// مسارات الكورسات
Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{id}', [CourseController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/enroll', [CourseController::class, 'enroll'])->name('enroll');
    
    // مسارات إضافية
    Route::get('/my-courses', [CourseController::class, 'myDesignerCourses'])->name('my-courses');
    Route::get('/designer/{id}', [CourseController::class, 'coursesByDesigner'])->name('by-designer');
});

// About and contact pages
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', function() {
    return view('contact');
})->name('contact');
Route::get('/blog', function() {
    return view('blog');
})->name('blog');
Route::get('/des', function() {
    return view('des');
})->name('des');


// Add these routes in the admin group
// Route::prefix('admin')->name('admin.')->group(function () {
//     // ... existing admin routes ...
    
//     // Coupon management routes
//     Route::resource('coupons', CouponAdminController::class);
// });

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Product management routes
    Route::get('/products', [ProductsAdminController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsAdminController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsAdminController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductsAdminController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductsAdminController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductsAdminController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductsAdminController::class, 'destroy'])->name('products.destroy');
    Route::patch('/products/{product}/status', [ProductsAdminController::class, 'updateStatus'])->name('products.status');
    
    // User management routes
    Route::resource('users', UserAdminController::class);
    
    // Order management routes
    Route::resource('orders', OrderAdminController::class)->except(['create', 'store']);
    
    // Category management routes
    Route::resource('categories', CategoryAdminController::class);
    
    // Course management routes
    Route::resource('courses', CoursesAdminController::class);
    Route::post('courses/{course}/learning-points', [CoursesAdminController::class, 'updateLearningPoints'])->name('courses.learning-points.update');

    // Coupon management routes
    Route::resource('coupons', CouponAdminController::class);
});

// Dashboard route provided by Laravel Breeze
Route::get('/dashboard', [DashboardController::class, 'index'])
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Include the authentication routes
require __DIR__.'/auth.php';

// Designer Dashboard Routes
use App\Http\Controllers\Designer\ProductController as DesignerProductController;
use App\Http\Controllers\Designer\CourseController as DesignerCourseController;
use App\Http\Controllers\Designer\DesignerSettings as DesignerSettingsController;

// Designer Dashboard Routes
Route::middleware(['auth'])->prefix('designer')->name('designer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Designer\DashboardController::class, 'index'])->name('dashboard');
    
    // Product CRUD routes
    Route::resource('products', DesignerProductController::class);
    
    // Course CRUD routes
    Route::resource('courses', DesignerCourseController::class);
    
    // Settings routes
    Route::post('/settings/account', [DesignerSettings::class, 'updateAccount'])->name('settings.account');
    Route::post('/settings/profile', [DesignerSettings::class, 'updateProfile'])->name('settings.profile');
    Route::delete('/settings/account', [DesignerSettings::class, 'deleteAccount'])->name('settings.delete');
});

// Add these routes to your web.php file
Route::prefix('designer')->name('designer.')->group(function () {
    Route::get('/orders', [App\Http\Controllers\Designer\OrderController::class, 'index'])
        ->name('orders.index');
    
    Route::get('/orders/{order}', [App\Http\Controllers\Designer\OrderController::class, 'show'])
        ->name('orders.show');
    
    Route::patch('/orders/{order}/status', [App\Http\Controllers\Designer\OrderController::class, 'updateStatus'])
        ->name('orders.update-status');
});

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthAdmin::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthAdmin::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthAdmin::class, 'logout'])->name('admin.logout');
    
    // Protected admin routes (accessible by both admin and superadmin)
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Product management routes
        Route::get('/products', [ProductsAdminController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductsAdminController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductsAdminController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}', [ProductsAdminController::class, 'show'])->name('admin.products.show');
        Route::get('/products/{product}/edit', [ProductsAdminController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductsAdminController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductsAdminController::class, 'destroy'])->name('admin.products.destroy');
        Route::patch('/products/{product}/status', [ProductsAdminController::class, 'updateStatus'])->name('admin.products.status');
        
        // Order management routes
        Route::resource('orders', OrderAdminController::class, ['as' => 'admin'])->except(['create', 'store']);
        
        // Category management routes
        Route::resource('categories', CategoryAdminController::class, ['as' => 'admin']);
        
        // Course management routes
        Route::resource('courses', CoursesAdminController::class, ['as' => 'admin']);
        Route::post('courses/{course}/learning-points', [CoursesAdminController::class, 'updateLearningPoints'])->name('admin.courses.learning-points.update');
        
        // Coupon management routes
        Route::resource('coupons', CouponAdminController::class, ['as' => 'admin']);
    });

    // SuperAdmin only routes
    Route::middleware(['superadmin.auth'])->group(function () {
        Route::get('/superadmin/dashboard', function () {
            return view('admin.superadmin.dashboard');
        })->name('admin.superadmin.dashboard');
        
        // User management routes (superadmin only)
        Route::resource('users', UserAdminController::class, ['as' => 'admin']);
        
        // System settings routes (superadmin only)
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('admin.settings');
        
        // Advanced system management routes here
    });
});