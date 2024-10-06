<?php


use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;



Route::get('/dashboard', function () {
    return view('dashboard.index');
});



    Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout']);







    // Menggunakan resource untuk membuat semua rute CRUD
    Route::resource('surat', SuratController::class);

    // Rute PUT dan GET untuk update dan edit (ini sebenarnya sudah dibuat oleh Route::resource)
    Route::put('surat/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::get('surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');

    // Rute untuk delete harus menggunakan metode DELETE, bukan GET
    Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');






    Route::get('/surat.create', [SuratController::class, 'buat'])->name('surat/create');
    Route::post('/surat.create', [SuratController::class, 'buat']);
    
    
    
    
    
    