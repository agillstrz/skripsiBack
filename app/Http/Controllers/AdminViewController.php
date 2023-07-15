<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
public function siswa($id) {
    $siswa = Siswa::with(['kelas','pembayaran'])->where('kelas_id', $id)->where('id','!=',1)->get();
    return response()->json([
        'data' => $siswa
    ]);
}
public function dashboard($id) {
    $siswa = Siswa::all()->count();
    $guru = Guru::all()->count();
    $kelas = Kelas::all()->count();
    return response()->json([
        'siswa' => $siswa,
        'guru' => $guru,
        'kelas' => $kelas,
    ]);
}
}