<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use App\Models\Brand;
use App\Models\HomeAbout;
use App\Models\HomeService;

//for query user
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands = Brand::all();
    // $abouts = DB::table('home_abouts')->first();
    $abouts = HomeAbout::first();
    $services = HomeService::all();

    $images = DB::table('multipics')->get();
    // $brands = DB::table('brands')->get();
    return view('home', compact('brands', 'abouts', 'services', 'images'));
});

Route::get('/home', function() {

    echo "This is home page";
});


// Route::get('/about', function() {

//     return view('about');
// })->middleware('age');


Route::get('/about', function() {

    return view('about');
});

//category controller

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);



// For brand route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/delete/brand/{id}', [BrandController::class, 'Delete']);


//Multi image

Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');

Route::post('/image/add', [BrandController::class, 'StoreImage'])->name('store.multiple');

//for logout

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');



//Admin slider route
Route::get('/home/slider', [HomeController::class, 'Homeslider'])->name('home.slider');

Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');

Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

Route::get('/slider/edit/{id}', [HomeController::class, 'EditSlider']);

Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider']);

Route::get('/delete/slider/{id}', [HomeController::class, 'DeleteSlider']);



// Home About
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');

Route::get('/home/add', [AboutController::class, 'AddAbout'])->name('add.about');

Route::post('/home/store', [AboutController::class, 'StoreAbout'])->name('store.about');

Route::get('/home/edit/{id}', [AboutController::class, 'EditAbout']);

Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);

Route::get('/delete/about/{id}', [AboutController::class, 'DeleteAbout']);

// Home Service

Route::get('/home/service', [ServiceController::class, 'HomeService'])->name('home.service');

Route::get('/service/add', [ServiceController::class, 'AddService'])->name('add.service');

Route::post('/service/store', [ServiceController::class, 'StoreService'])->name('store.service');

Route::get('/service/edit/{id}', [ServiceController::class, 'EditService']);

Route::post('/service/update/{id}', [ServiceController::class, 'UpdateService']);

Route::get('/delete/service/{id}', [ServiceController::class, 'DeleteService']);

// For email verification


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route::get('/contact', function() {

//     return view('contact');
// });

Route::get('/contact', [ContactController::class, 'index'])->name('ngozi');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        
        //eloquent
        // $users = User::all();

        // query builder

        
        return view('admin.index');
    })->name('dashboard');


   
});

Route::get('/phpinfo', function() {
    return phpinfo();
});

