<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiJadwalController extends Controller
{
    public function NilaiByJadwal (Request $request){

        $jadwal = Jadwal::with(['kelas', 'pelajaran'])
        ->where('kelas_id', $request->kelas_id)
        ->latest()
        ->get();
        $uniqueJadwal = $jadwal->unique(function ($item) {
        return $item->pelajaran_id;
    });
    
    $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();

    $cekNilaiSemester = Nilai::where('kelas_id', $request->kelas_id)->where('semester_id', $request->semester_id)->exists();
    if(!$cekNilaiSemester){
        foreach($siswa as $siswas){
            $pembayaran =  Pembayaran::create([
                'siswa_id' => $siswas->id,
                'kelas_id' => $siswas->kelas_id,
                'semester_id' => $request->semester_id,
                'jumlah' => 250000,
            ]);
            foreach ($uniqueJadwal as $pelajaran) {
                $nilai =  Nilai::create([
                    'pelajaran_id' => $pelajaran->pelajaran_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswas->id,
                    'nilai' => 0,
                ]);
    
                $nnilaiUjian =  NilaiUjian::create([
                    'pelajaran_id' => $pelajaran->pelajaran_id,
                    'semester_id' =>  $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswas->id,
                    'nilai' => 0,
                ]); 
            }
        }
        return response()->json([
            'message' => 'Nilai berhasil ditambahkan'
        ]);

        } else{
            return response()->json([
                'message' => 'Nilai Sudah Dibuat'
            ]);
        }
    }
  


  

        
}