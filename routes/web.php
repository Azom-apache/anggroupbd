<?php

use App\Models\Blog;
use App\Models\Team;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use App\Models\Client;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Category;
use App\Enum\CommonStatus;
use App\Enum\ProductStatus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ProfileController;
use App\Models\Certificate;

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
    $sliders = Slider::whereStatus(CommonStatus::Active)->get();
    $products = Product::whereStatus(ProductStatus::Active)->get();
    $spairproducts = Product::where('brand_id', 2)->whereStatus(ProductStatus::Active)->get();
    $clients = Client::whereStatus(CommonStatus::Active)->get();
    $certificates = Certificate::whereStatus(CommonStatus::Active)->get();
    $blogs = Blog::whereStatus(CommonStatus::Active)->get();
    $partners = Gallery::get();
    $categorys = Category::whereStatus(CommonStatus::Active)->take(3)->get();
    $notices = Notice::take(6)->get();
    return view('frontend.home', compact('certificates','partners','blogs','sliders', 'products', 'clients', 'categorys', 'spairproducts','notices'));
});
Route::get('/search', [CommonController::class, 'search'])->name('search');
Route::get('/categoryproduct', [CommonController::class, 'categoryproduct'])->name('categoryproduct');
Route::get('/sister', [CommonController::class, 'sister'])->name('sister');
Route::get('/products', [CommonController::class, 'products'])->name('products');




Route::get('productsPage', function () {
    $products = Category::all();
    return view('frontend.productsPage', compact('products'));
})->name('productsPage');
Route::get('product2/{id}', function ($id) {
    $products = Product::with('productImages')->where('category_id',$id)->get();
    return view('frontend.product2', compact('products'));
})->name('product2');
Route::get('sparePartsPage', function () {
    $spairproducts = Product::where('brand_id', 2)->whereStatus(ProductStatus::Active)->get();
    return view('frontend.sparePartsPage', compact('spairproducts'));
})->name('sparePartsPage');

Route::get('sustainability', function () {
    return view('frontend.sustainability');
})->name('sustainability');
Route::get('ceomessage', function () {
    return view('frontend.ceomessage');
})->name('ceomessage');

Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');
Route::get('capability', function () {
    return view('frontend.inquire');
})->name('capability');

Route::get('career', function () {
    return view('frontend.career');
})->name('career');

Route::get('newsevent', function () {
    $newsevent = Blog::all();
    return view('frontend.newsevent',compact('newsevent'));
})->name('newsevent');

Route::get('culturalactivity', function () {
    $newsevent = Blog::all();
    return view('frontend.culturalactivity',compact('newsevent'));
})->name('culturalactivity');

Route::get('mefacturing', function () {
    $newsevent = Blog::all();
    return view('frontend.mefacturing',compact('newsevent'));
})->name('mefacturing');

Route::get('mechineauto', function () {
    $newsevent = Blog::all();
    return view('frontend.mechineauto',compact('newsevent'));
})->name('mechineauto');
Route::get('members', function () {
    $members = User::all();
    return view('frontend.client',compact('members'));
})->name('members');

Route::get('service', function () {
    return view('frontend.service');
})->name('service');

Route::get('mission', function () {
    return view('frontend.mission');
})->name('mission');

Route::get('boardofadvisor', function () {
    $teams = Team::all();
    return view('frontend.vission',compact('teams'));
})->name('boardofadvisor');

Route::get('boardofdirector', function () {
    $members = Client::all();
    return view('frontend.boardofdirector', compact('members'));
})->name('boardofdirector');
Route::get('companyprofile', function () {
    return view('frontend.companyprofile');
})->name('companyprofile');
Route::get('video', function () {
    $videos = Video::all();
    return view('frontend.video', compact('videos'));
})->name('video');
Route::get('image', function () {
    $images = Gallery::all();
    return view('frontend.image', compact('images'));
})->name('image');
Route::get('singleProduct/{id}', function ($id) {
    $singleProduct = Product::with('productImages')->with('productImages')->find($id);
    return view('frontend.singleProduct', compact('singleProduct'));
})->name('singleProduct');

Route::get('singleCategory/{id}', function ($id) {
    $singleProduct = Category::find($id);
    return view('frontend.singleCategory', compact('singleProduct'));
})->name('singleCategory');

Route::get('/new', function () {
    return view('frontend.welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::resource('cart', \App\Http\Controllers\CartController::class)->only([
    'index',
    'store',
    'destroy'
]);

Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

//Route::get('/cart/updatee/{id}', 'CartController@update')->name('cart.updatee');
Route::resource('checkout', \App\Http\Controllers\CheckoutController::class);

Route::middleware('auth')->group(function () {
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('portal/{user}', \App\Http\Controllers\PortalController::class)->name('portal');
Route::resource('vendorregister', \App\Http\Controllers\VendorController::class);
use App\Http\Controllers\ContactController;

Route::post('/contact-submit', [CommonController::class, 'submit'])->name('contact.submit');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
