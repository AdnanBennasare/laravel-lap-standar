<?php
use App\Http\Controllers\type_handicapController;
use Illuminate\Support\Facades\Route;

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

// Route::post('/search-handicap', [type_handicapController::class, 'searchhandicap'])->name('search');
Route::resource('typeHandicap', type_handicapController::class);
// Route::get('/search-handicap', type_handicapController::class);

Route::get('/search-handicap', [type_handicapController::class, 'searchHandicap']);


// Route::post('/search', [type_handicapController::class, 'search'])->name('search');

// Route::get('/filter', [type_handicapController::class, 'search']);


// Route::get('/typeHandicap/search', [TypeHandicapController::class, 'search'])->name('typeHandicap.search');


