<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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

Route::controller(ListingController::class)->group(function () { 
    // All Listings
    Route::get('/', 'index')->name('listing.index');

    // show create form
    Route::get('listings/create', 'create')->name('listing.create')->middleware('auth');
    
    // store listing
    Route::post('listings', 'store')->middleware('auth');

    // single listing
    Route::get('listings/{listing}', 'show')->name('listing.show');
    
    //Show Edit single listing
    Route::get('listings/{listing}/edit', 'edit')->middleware('auth');

    // Update single listing
    Route::put('listings/{listing}', 'update')->middleware('auth');

    // Delete listing
    Route::delete('listings/{listing}', 'destroy')->middleware('auth');
});

// To show the login page
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// To show Registration form
Route::get('/register', [UserController::class, 'create'])->name('user.register')->middleware('guest');

// To store users
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// To authenticate the users
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Manage Listings
Route::get('/manage', [ListingController::class, 'manage'])->middleware('auth');
