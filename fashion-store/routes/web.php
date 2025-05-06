 <?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


//Route::get('/', [HomeController::class, 'landingPage'])->name('landing');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// // Make sure these routes exist for the landing page links
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::get('/designers', function() {
//     $designers = User::where('is_designer', true)->paginate(12);
//     return view('designers.index', compact('designers'));
// })->name('designers.index');


// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CourseController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\FavoriteController;
// use App\Http\Controllers\DesignerController;
// use Illuminate\Support\Facades\Route;




// Route::get('/landing', [HomeController::class, 'landingPage'])->name('landing');


// Route::get('/locale/{locale}', [HomeController::class, 'setLocale'])->name('locale.set');


// Route::post('/newsletter', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
//     Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
//     Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// });


// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Route::get('/designers', [DesignerController::class, 'index'])->name('designers.index');
// Route::get('/designers/{user}', [DesignerController::class, 'show'])->name('designers.show');

// // Cart routes that don't require authentication
// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
// Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// // About and contact pages
// Route::get('/about', function() {
//     return view('about');
// })->name('about');

// Route::get('/contact', function() {
//     return view('contact');
// })->name('contact');

// // Dashboard route provided by Laravel Breeze
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// // Include the authentication routes
// require __DIR__.'/auth.php'; -->




use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [HomeController::class, 'landingPage'])->name('landing');

// Product routes with model binding
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Locale setter
Route::get('/locale/{locale}', [HomeController::class, 'setLocale'])->name('locale.set');

// Newsletter subscription
Route::post('/newsletter', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Authentication routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Favorites routes
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // Ratings routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});


// Course routes with model binding
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Designer routes with model binding
Route::get('/designers', [DesignerController::class, 'index'])->name('designers.index');
Route::get('/designers/{user}', [DesignerController::class, 'show'])->name('designers.show');

// Cart routes that don't require authentication
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// About and contact pages
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', function() {
    return view('contact');
})->name('contact');

// Dashboard route provided by Laravel Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Include the authentication routes
require __DIR__.'/auth.php';