<?php

namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use App\Models\NilaiUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $JadwalUjian = JadwalUjian::with(['pelajaran','kelas'])->latest()->paginate(10);
        return response()->json([
            'data' => $JadwalUjian
        ]);
    }
 


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $JadwalUjian = JadwalUjian::create([
            'pelajaran_id' => $request->pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'pengawas' => $request->pengawas,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);
        
        return response()->json([
            'data' => $JadwalUjian,
            'message'=>"data berhasil ditambahkan"
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $jadwal = JadwalUjian::find($id);
        $jadwal->pelajaran_id =  $request->pelajaran_id;
        $jadwal->kelas_id =  $request->kelas_id;
        $jadwal->hari =  $request->hari;
        $jadwal->tanggal =  $request->tanggal;
        $jadwal->mulai =  $request->mulai;
        $jadwal->selesai =  $request->selesai;
        $jadwal->save();
        return response()->json([
            'data' => $jadwal,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalUjian::find($id);
        $jadwal->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}