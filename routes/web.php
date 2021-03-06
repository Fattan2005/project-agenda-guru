<?php

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\GuruviewController;

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
    $jumlahguru = Guru::count();
    $jumlahkelas = Kelas::count();
    $jumlahmapel = Mapel::count();
    return view('index', ["title" => "Home"], compact('jumlahguru', 'jumlahkelas', 'jumlahmapel'));
})->middleware('auth');

Route::group(['middleware' =>['auth', 'hakakses:user']], function(){
    Route::get('/guruview', [GuruviewController::class, 'guruview'])->name('guruview')->middleware('auth');
});

//guruview
Route::get('/tambahguruview', [GuruviewController::class, 'create'])->name('tambahguruview')->middleware('auth');
Route::post('/insertguruview', [GuruviewController::class, 'store'])->name('insertguruview');
    
// kelas
    
Route::get('/kelas', [KelasController::class, 'kelas'])->name('kelas')->middleware('auth');

Route::get('/tambahkelas', [KelasController::class, 'create'])->name('tambahkelas');
Route::post('/insertkelas', [KelasController::class, 'store'])->name('insertkelas');

Route::get('/editkelas/{id}', [KelasController::class, 'tampilan'])->name('editkelas');
Route::put('/updatekelas/{id}', [KelasController::class, 'update'])->name('updatekelas');

Route::delete('/deletekelas/{id}', [KelasController::class, 'destroy'])->name('deletekelas');

//guru
Route::get('/guru', [GuruController::class, 'guru'])->name('guru')->middleware('auth');

Route::get('/tambahguru', [GuruController::class, 'create'])->name('tambahguru');
Route::post('/insertguru', [GuruController::class, 'store'])->name('insertguru');

Route::get('/editguru/{id}', [GuruController::class, 'tampilan'])->name('editguru');
Route::put('/updateguru/{id}', [GuruController::class, 'update'])->name('updateguru');

Route::delete('/deleteguru/{id}', [GuruController::class, 'destroy'])->name('deleteguru');

//agenda
Route::get('/agenda', [AgendaController::class, 'agenda'])->name('agenda')->middleware('auth');

Route::get('/tambahagenda', [AgendaController::class, 'create'])->name('tambahagenda');
Route::post('/insertagenda', [AgendaController::class, 'store'])->name('insertagenda');

Route::get('/editagenda/{id}', [AgendaController::class, 'tampilan'])->name('editagenda');
Route::put('/updateagenda/{id}', [AgendaController::class, 'update'])->name('updateagenda');

Route::delete('/deleteagenda/{id}', [AgendaController::class, 'destroy'])->name('deleteagenda');

//mapel
Route::get('/mapel', [MapelController::class, 'mapel'])->name('mapel')->middleware('auth');

Route::get('/tambahmapel', [MapelController::class, 'create'])->name('tambahmapel');
Route::post('/insertmapel', [MapelController::class, 'store'])->name('insertmapel');

Route::get('/editmapel/{id}', [MapelController::class, 'tampilan'])->name('editmapel');
Route::put('/updatemapel/{id}', [MapelController::class, 'update'])->name('updatemapel');

Route::delete('/deletemapel/{id}', [MapelController::class, 'destroy'])->name('deletemapel');


// login register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/loginadmin', [LoginController::class, 'loginadmin'])->name('loginadmin');
Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
Route::post('/loginadmin', [LoginController::class, 'loginadminpost'])->name('loginadmin');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');