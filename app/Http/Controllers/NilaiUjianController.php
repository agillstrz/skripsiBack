<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjian;
use Illuminate\Http\Request;

class NilaiUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jadwal = NilaiUjian::with(['pelajaran','kelas','semester'])->where('siswa_id', $request->siswa_id)->where('semester_id', $request->semester_id)->latest()->paginate(10);
        return response()->json([
            'data' => $jadwal
        ]);
    }

    public function update(Request $request,  $id)
    {
        $nilai = NilaiUjian::find($id);
        $nilai->nilai = $request->nilai;
        $nilai->save();
        
        return response()->json($nilai);
  
    }


   

    public function destroy(NilaiUjian $nilaiUjian)
    {
        //
    }
}