<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
public function siswa($id) {
    $siswa = Siswa::with(['kelas','pembayaran'])->where('kelas_id', $id)->where('id','!=',1)->orderBy('nama', 'asc')->get();
    return response()->json([
        'data' => $siswa
    ]);
}
public function semesterPublish() {
    $Semester = Semester::first();
    return response()->json($Semester);
}
public function semuaSiswa(Request $request) {
    $keyword = $request->keyword;
    $siswa = Siswa::with(['kelas','pembayaran'])->where('id','!=',1)->where('nama', 'LIKE', "%$keyword%")->orderBy('nama', 'asc')->paginate(20, ['*'], 'page', $request->page);
    return response()->json([
        'data' => $siswa
    ]);
}
public function dashboard() {
    $siswa = Siswa::count();
    $guru = Guru::count();
    $kelas = Kelas::count();
    $Pelajaran = Pelajaran::count();
    return response()->json([
        'siswa' => $siswa,
        'guru' => $guru,
        'kelas' => $kelas,
        'pelajaran' => $Pelajaran,
    ]);
}
}