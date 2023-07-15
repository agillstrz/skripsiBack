<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jadwal = Jadwal::with(['guru','pelajaran','kelas'])->where('kelas_id', $request->kelas_id)->paginate(10);
        return response()->json([
            'data' => $jadwal
        ]);
    }
    public function JadwalKelas(Request $request)
    {
        $jadwal = Kelas::with('jadwal')->where('id', $request->id)->latest()->paginate(10);
        return response()->json([
            'data' => $jadwal
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jadwal = Jadwal::create([
            'pelajaran_id' => $request->pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'guru_id' => $request->guru_id,
            'hari' => $request->hari,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);

        return response()->json([
            'data' => $jadwal,
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
        $jadwal = Jadwal::find($id);
        $jadwal->guru_id =  $request->guru_id;
        $jadwal->pelajaran_id =  $request->pelajaran_id;
        $jadwal->kelas_id =  $request->kelas_id;
        $jadwal->hari =  $request->hari;
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
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}