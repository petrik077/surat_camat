<?php


use App\Models\Surat;
use App\Models\User;
use App\Models\Rekap;
use App\Models\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\RegisterController;



Route::get('/dashboard', function () {
    return view('dashboard.index');
});



    Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout']);






    Route::resource('register', RegisterController::class);
    Route::get('register', [RegisterController::class, 'index'])->name('register.index');
    
    Route::get('/register.index', [RegisterController::class, 'store'])->name('register.create');
    Route::post('/register.index', [RegisterController::class, 'store']);
    
    
    Route::resource('registrasi', RegisterController::class);
    Route::get('registrasi', [RegisterController::class, 'index2'])->name('registrasi.index');
    
    Route::get('/registrasi.index', [RegisterController::class, 'store2'])->name('register.store2');
    Route::post('/registrasi.index', [RegisterController::class, 'store2']);













    // Menggunakan resource untuk membuat semua rute CRUD
    Route::resource('surat', SuratController::class);
    Route::get('surat', [SuratController::class, 'index'])->name('surat.index');

    // Rute PUT dan GET untuk update dan edit (ini sebenarnya sudah dibuat oleh Route::resource)
    Route::get('/surat/{nomor_surat}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{nomor_surat}', [SuratController::class, 'update'])->name('surat.update');
    

    


    Route::get('/surat/destroy/{nomor_surat}', [SuratController::class,'store']);





    Route::get('/surat.create', [SuratController::class, 'buat'])->name('surat/create');
    Route::post('/surat.create', [SuratController::class, 'buat']);
    

    Route::delete('/surat/delete/{nomor_surat}', [SuratController::class, 'delete'])->name('surat.delete');
    Route::get('/surat/detail/{nomor_surat}', [SuratController::class, 'detail'])->name('surat.detail');
    Route::get('/surat/setuju/{nomor_surat}', [SuratController::class, 'setuju'])->name('surat.setuju');
    Route::get('/surat/tdksetuju/{nomor_surat}', [SuratController::class, 'tdksetuju'])->name('surat.tdksetuju');

    Route::get('/surat/template', [SuratController::class, 'template'])->name('surat.template');
    Route::get('/surat/template/{nomor_surat}', [SuratController::class, 'template'])->name('surat.template');
    
    Route::get('/surat/templaterekap', [SuratController::class, 'templaterekap'])->name('surat.templaterekap');
    Route::get('/surat/templaterekap/{id_rekap}', [SuratController::class, 'templaterekap'])->name('surat.templaterekap');
    
    





    ////////////////////////////////////////////////////SURAT MASUK///////////////////////////////////////////////////////////////////
    Route::resource('suratmasuk', SuratMasukController::class);
    Route::get('suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk.index');
    
    Route::get('/suratmasuk.create', [SuratController::class, 'create'])->name('suratmasuk/create');
    Route::post('/suratmasuk.create', [SuratController::class, 'create']);
    
    Route::post('/suratmasuk.store', [SuratController::class, 'store'])->name('suratmasuk/store') ;

    Route::delete('/suratmasuk/delete/{id_suratmasuk}', [SuratMasukController::class, 'delete'])->name('suratmasuk.delete');









/////////////////////////////////////////////////////////////////////    Jenis Surat   ////////////////////////////////////////////////////
    Route::resource('jenissurat', JenisSuratController::class);
    Route::get('jenissurat', [JenisSuratController::class, 'index'])->name('jenissurat.index');
    
    Route::get('/jenissurat.create', [JenisSuratController::class, 'buatjenis'])->name('jenissurat/create');
    Route::post('/jenissurat.create', [JenisSuratController::class, 'buatjenis']);

    Route::put('/surat/{nomor_surat}', [SuratController::class, 'update'])->name('surat.update');




    
    Route::get('/rekap', [SuratController::class, 'rekap'])->name('surat.rekap');
    



    Route::get('/getSurat/{id}', [SuratController::class, 'getSurat'])->name('getSurat');

    