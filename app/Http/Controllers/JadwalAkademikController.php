<?php

namespace App\Http\Controllers;

use App\Models\JadwalAkademik;
use Illuminate\Http\Request;

class JadwalAkademikController extends Controller
{
    public function index()
    {
        $jadwal = JadwalAkademik::all();

        return response()->json($jadwal); 
    }
    public function store(Request $request)
    {
        $jadwal = JadwalAkademik::create([
            'kegiatan' => $request->kegiatan,
            'mulai' => $request->mulai,
            'akhir' => $request->akhir,
          
        ]);

        return response()->json($jadwal); 
    }
    public function update(Request $request, $id)
    {
        $jadwal = JadwalAkademik::find($id);
        $jadwal->kegiatan =  $request->kegiatan;
        $jadwal->mulai =  $request->mulai;
        $jadwal->akhir =  $request->akhir;
     
        $jadwal->save();

        return response()->json($jadwal); 
    }

    public function destroy($id)
    {
        $jadwal = JadwalAkademik::find($id);
        $jadwal->delete();
        return response()->json([
            'Message' => "data berhasil dihapus"
        ]);
    }

}