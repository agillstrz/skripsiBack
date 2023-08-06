<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jadwal = Nilai::with(['pelajaran','kelas','semester'])->where('siswa_id', $request->siswa_id)->where('semester_id', $request->semester_id)->latest()->paginate(10);
        return response()->json([
            'data' => $jadwal
        ]);
    }

    // public function index(Request $request)
    // {
    //     $jadwal = Jadwal::with(['kelas', 'pelajaran'])
    //     ->where('kelas_id', $request->kelas_id)
    //     ->latest()
    //     ->get();

    // // Menghapus duplikat berdasarkan pelajaran_id
    // $uniqueJadwal = $jadwal->unique(function ($item) {
    //     return $item->pelajaran_id;
    // });

    // return response()->json([
    //     'data' => $uniqueJadwal
    // ]);
    // }
    public function nilaiAkademik(Request $request)
    {
        $jadwal = Nilai::with(['siswa', 'pelajaran',''])->where('kelas_id', $request->kelas)->latest()->paginate(10);
        return response()->json([
            'data' => $jadwal
        ]);
    }




    public function nilaiKelas(Request $request)
    {
        $kelas = Kelas::with(['siswa','pelajaran','semester'])->where('kelas_id', $request->kelas_id)->latest()->paginate(10);
        return response()->json([
            'data' => $kelas
        ]);
    }

    
 


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
       
        
        

    //     $keterangan = "";
    //     if($request->nilai >= 95){
    //       $keterangan = "sangat baik";
    //     } 
    //     else if($request->nilai >= 85){
    //       $keterangan = "baik";
    //     } 
    //     else if($request->nilai >= 75){
    //       $keterangan = "memuaskan";
    //     } 
        
    //     $nilai = Nilai::create([
    //         'semester_id' => $request->semester_id,
    //         'pelajaran_id' => $request->pelajaran_id,
    //         'kelas_id' => $request->kelas_id,
    //         'siswa_id' => $request->siswa_id,
    //         'nilai' => $request->nilai,
    //         'status' => $request->status,
    //         'keterangan' => $keterangan,
        
    //     ]);

    //     return response()->json([
    //         'data' => $nilai,
    //         'message'=>"data berhasil ditambahkan"
    //     // ]); 
    // }

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
        
        $nilais = Nilai::find($id);
        $nilai = $request->nilai;
        $kkm = $nilais->pelajaran->kkm;
        $jarak = $nilai - $kkm; 
        $nilais->nilai =  $request->nilai;

                if ($nilai >= $kkm) {
                    $nilais->keterangan = "lulus";
                if ($nilai == 100) {
                    $nilais->status = "Sangat Baik";
                }
                else if ($jarak >= 15) {
                    $nilais->status = "Sangat Baik";
                } 
                 else if ($jarak >= 10) {
                    $nilais->status = "Baik";
                } else if ($jarak >= 5) {
                    $nilais->status = "Cukup";
                } else {
                    $nilais->status = "Kurang";
                }
            } else {
                $nilais->status = "Belum Tuntas";
                $nilais->keterangan = "belum lulus";
            }

        $nilais->save();
        
        return response()->json($nilais);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = Nilai::find($id);
        $jadwal->delete();
        return response()->json([
            'Message' => "data berhasil dihapus"
        ]);
    }
}