<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\JadwalUjian;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\Pelajaran;
use App\Models\Pembayaran;
use App\Models\Publish;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAkademikController extends Controller
{
    public function profile(Request $request) { 

        $profile = Siswa::with('kelas')->where('id',Auth::id())->first();
       
        return response()->json([
            'data' => $profile
        ]);
    }
    public function getProfile() { 

        $profile = Siswa::with('kelas')->where('id',Auth::id())->first();
        return response()->json($profile);
    }
    public function jadwalPelajaran(Request $request) { 

        $profile = Jadwal::where('kelas_id', $request->kelas_id)->with(['kelas','pelajaran','guru'])->latest()->get();
        return response()->json([
            'data' => $profile
        ]);
    }
    public function jadwalUjian(Request $request) { 

        $jadwal = JadwalUjian::where('kelas_id', $request->kelas_id)->with(['kelas','pelajaran'])->get();
        return response()->json($jadwal);
    }

    public function nilaiAkademikSiswa(Request $request) { 

        $nilais = Nilai::where('siswa_id',Auth::id())->where('semester_id', $request->semester)->with(['pelajaran','semester'])->get();

        $ratas = Nilai::where('siswa_id',Auth::id())->avg('nilai');
     
        $nilaiTotal = Nilai::where('siswa_id',Auth::id())->sum('nilai');
        $rata = number_format($ratas, 1, '.', '');
        $pelajaran = Nilai::where('siswa_id',Auth::id())->count();

     
        return response()->json([
            'data' => $nilais,
            'jumlah' => $nilaiTotal,
            'rata' => $rata,
            'pelajaran' => $pelajaran,
        ]);
    }
    public function nilaiUjianSiswa(Request $request) { 
        
        $nilai = NilaiUjian::where('siswa_id', Auth::id())->where('semester_id', $request->semester)->with(['pelajaran','semester'])->latest()->get();
        return response()->json([
            'data' => $nilai
        ]);
    }
    public function pembayaranSiswa(Request $request) { 
        
        $pembayaran = Pembayaran::where('siswa_id', Auth::id())->with(['kelas','semester'])->get();
        return response()->json($pembayaran);
    }
    public function nilaiTotal(Request $request) { 


        $nilaiTotal =0;
        $rata = 0;
        $totalPelajaran = Nilai::where('siswa_id', Auth::id())->count();
        $nilais = Nilai::where('siswa_id', Auth::id())->get();

        foreach($nilais as $nilai){
            $nilaiTotal+=$nilai->nilai;
        }
        $rata = $nilaiTotal/$totalPelajaran;


        return response()->json([
            'jumlah' => $nilaiTotal,
            'rata' => $rata
        ]);
    }

}