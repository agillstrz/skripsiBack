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
        $kkm = $nilai->pelajaran->kkm ;
        if($request->nilai >= 100){
            $nilai->status = 'sangat baik';

        } else if($request->nilai >= $kkm ){
                if(($request->nilai - $kkm) <=5 && ($request->nilai - $kkm) <=10 ){
                    $nilai->status = 'baik';
                }
                if($request->nilai - $kkm >=10 && $request->nilai - $kkm <=15 ){
                    $nilai->status = 'memuaskan';
                } else{
                    $nilai->status = 'cukup memuaskan';
                }
        } else {
            $nilai->status = 'tidak memuaskan';
        }

        if($request->nilai >= $nilai->nilai){
            $nilai->keterangan = 'Lulus';
        } else{
            $nilai->keterangan = 'tidak lulus';
        }

        $nilai->save();
        
        return response()->json($nilai);
        // $nilai->save();
        // return response()->json([
        //     'data' => $nilai,
        //     'message'=>"data berhasil diperbarui"
        // ]); 
    }


   

    public function destroy(NilaiUjian $nilaiUjian)
    {
        //
    }
}