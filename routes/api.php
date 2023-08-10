<?php

use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Frontend\SiswaAkademikController;
use App\Http\Controllers\Frontend\SiswaAkadmeikController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalAkademikController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalUjianController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiJadwalController;
use App\Http\Controllers\NilaiUjianController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Models\JadwalAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/register', [RegisterController::class, 'Register']);
Route::post('auth/TambahSiswBaru', [RegisterController::class, 'TambahSiswBaru']);
Route::post('auth/login', [LoginController::class,'Login']);
Route::post('auth/ubah-password', [RegisterController::class,'ubahPassword'])->middleware('auth:sanctum');


Route::post('kategori', [KategoriBeritaController::class, 'store']);
Route::put('kategori/{id}', [KategoriBeritaController::class, 'update']);
Route::delete('kategori/{id}', [KategoriBeritaController::class, 'destroy']);
Route::get('kategori', [KategoriBeritaController::class, 'index']);


Route::post('berita', [BeritaController::class, 'store']);
Route::put('berita/{id}', [BeritaController::class, 'update']);
Route::delete('berita/{id}', [BeritaController::class, 'destroy']);
Route::get('berita', [BeritaController::class, 'index']);


Route::post('guru', [GuruController::class, 'store']);
Route::put('guru/{id}', [GuruController::class, 'update']);
Route::delete('guru/{id}', [GuruController::class, 'destroy']);
Route::get('guru', [GuruController::class, 'index']);

Route::post('siswa', [SiswaController::class, 'store']);
Route::put('siswa/{id}', [SiswaController::class, 'update']);
Route::delete('siswa/{id}', [SiswaController::class, 'destroy']);
Route::get('siswa', [SiswaController::class, 'index']);

Route::post('kelas', [KelasController::class, 'store']);
Route::put('kelas/{id}', [KelasController::class, 'update']);
Route::delete('kelas/{id}', [KelasController::class, 'destroy']);
Route::get('kelas', [KelasController::class, 'index']);

Route::post('jenjang', [JenjangController::class, 'store']);
Route::put('jenjang/{id}', [JenjangController::class, 'update']);
Route::delete('jenjang/{id}', [JenjangController::class, 'destroy']);
Route::get('jenjang', [JenjangController::class, 'index']);


Route::post('jadwal', [JadwalController::class, 'store']);
Route::get('JadwalKelas', [JadwalController::class, 'JadwalKelas']);
Route::put('jadwal/{id}', [JadwalController::class, 'update']);
Route::delete('jadwal/{id}', [JadwalController::class, 'destroy']);
Route::get('jadwal', [JadwalController::class, 'index']);


Route::post('jadwalAkademik', [JadwalAkademikController::class, 'store']);
Route::get('jadwalAkademik', [JadwalAkademikController::class, 'index']);
Route::put('jadwalAkademik/{id}', [JadwalAkademikController::class, 'update']);
Route::delete('jadwalAkademik/{id}', [JadwalAkademikController::class, 'destroy']);

// Route::post('nilai', [NilaiController::class, 'store']);
Route::get('nilaiAkademik', [NilaiController::class, 'nilaiAkademik']);
Route::get('nilaiKelas', [NilaiController::class, 'nilaiKelas']);
Route::put('nilai/{id}', [NilaiController::class, 'update']);
Route::delete('nilai/{id}', [NilaiController::class, 'destroy']);
Route::get('nilai', [NilaiController::class, 'index']);


Route::get('nilaiUjian', [NilaiUjianController::class, 'index']);
Route::put('nilaiUjian/{id}', [NilaiUjianController::class, 'update']);


Route::post('pelajaran', [PelajaranController::class, 'store']);
Route::put('pelajaran/{id}', [PelajaranController::class, 'update']);
Route::delete('pelajaran/{id}', [PelajaranController::class, 'destroy']);
Route::get('pelajaran', [PelajaranController::class, 'index']);



Route::post('pembayaran', [PembayaranController::class, 'store']);
Route::put('pembayaran/{id}', [PembayaranController::class, 'update']);
Route::delete('pembayaran/{id}', [PembayaranController::class, 'destroy']);
Route::get('pembayaran', [PembayaranController::class, 'index']);
Route::get('pembayaran/{id}', [PembayaranController::class, 'detailPembayaran']);




Route::get('siswa/{id}', [AdminViewController::class, 'siswa']);
Route::get('semuaSiswa', [AdminViewController::class, 'semuaSiswa']);
Route::get('dashboard', [AdminViewController::class, 'dashboard']);
Route::get('semesterPublish', [AdminViewController::class, 'semesterPublish']);
Route::post('semester', [SemesterController::class, 'store']);
Route::get('semester', [SemesterController::class, 'index']);
Route::put('semester/{id}', [SemesterController::class, 'update']);
Route::get('semesterSekarang', [SemesterController::class, 'semesterSekarang']);

Route::post('jadwalUjian', [JadwalUjianController::class, 'store']);
Route::get('jadwalUjian', [JadwalUjianController::class, 'index']);
Route::put('jadwalUjian/{id}', [JadwalUjianController::class, 'update']);
Route::delete('jadwalUjian/{id}', [JadwalUjianController::class, 'destroy']);
Route::get('jadwalUjian', [JadwalUjianController::class, 'index']);




Route::get('profile', [SiswaAkademikController::class, 'profile'])->middleware('auth:sanctum');
Route::get('getProfile', [SiswaAkademikController::class, 'getProfile'])->middleware('auth:sanctum');
Route::get('nilaiSiswa', [SiswaAkademikController::class, 'nilaiAkademikSiswa'])->middleware('auth:sanctum');
Route::get('nilaiUjianSiswa', [SiswaAkademikController::class, 'nilaiUjianSiswa'])->middleware('auth:sanctum');
Route::get('jadwalPelajaranSiswa', [SiswaAkademikController::class, 'jadwalPelajaran'])->middleware('auth:sanctum');
Route::get('jadwalUjianSiswa', [SiswaAkademikController::class, 'jadwalUjian'])->middleware('auth:sanctum');
Route::get('pembayaranSiswa', [SiswaAkademikController::class, 'pembayaranSiswa'])->middleware('auth:sanctum');
Route::get('nilaiTotal', [SiswaAkademikController::class, 'nilaiTotal'])->middleware('auth:sanctum');;


Route::post('createNilai', [NilaiJadwalController::class, 'NilaiByJadwal']);