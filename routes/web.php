<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VehicleController;
use App\Livewire\Categories\ShowCategories;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RevenuesController;
use App\Http\Controllers\Auth\SocialiteController;

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
Route::get('/migrate', function () {
    Artisan::call('create:users 5');

    return 'Database users success.';
});

Route::get('/backup', function () {
    // Artisan::call('app:database-backup');
    Artisan::call('backup:run');

    return 'Database backup success.';
});

Route::get('/schedule', function () {
    Artisan::call('schedule:work');

    return 'Database backup success.';
});


// --------------- [ Route Normal Auth & Verfiy ] -------------------\\
Auth::routes(['register' => false, 'verify' => true]);


// --------------- [ Route Auth Social Media ] -------------------\\
Route::prefix('auth/')->controller(SocialiteController::class)->group(function () {
    Route::get('{provider}', 'redirect');
    Route::get('{provider}/callback', 'callback');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    
    // Route::resource('/roles', RoleController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');


    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/statuses', [StatusController::class, 'index'])->name('statuses');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas');
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('/socials', [SocialController::class, 'index'])->name('socials');
    
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses');
    Route::get('/revenues', [RevenuesController::class, 'index'])->name('revenues');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/trips', [TripController::class, 'index'])->name('trips');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');

    // Route::get('/categories', ShowCategories::class)->name('categories');
});
