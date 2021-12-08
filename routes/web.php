<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/candidates/{candidate}')->name('candidates.')->group(function () {
        Route::get('/cv', [CandidateController::class, 'downloadCv'])->name('download.cv');
        Route::post('/', [CandidateController::class, 'updateStatus'])->name('status.update');
    });

    Route::resource('candidates', CandidateController::class)->only([
       'index', 'create', 'store', 'edit', 'destroy'
    ]);
});

require __DIR__.'/auth.php';
