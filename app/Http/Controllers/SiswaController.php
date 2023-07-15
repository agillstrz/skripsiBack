<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->latest()->paginate(5);
        return response()->json([
            'data' => $siswa
        ]);

    }
    public function Profile($id)
    {
        $siswa = Siswa::find($id);
        return response()->json([
            'data' => $siswa
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'kelas_id' => $request->kelas_id,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'foto' => $request->foto,
            'jenjang' => $request->jenjang,
            'angkatan' => $request->angkatan,
        ]);

        return response()->json([
            'data' => $siswa,
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
        $siswa = Siswa::find($id);
        $siswa->alamat = $request->alamat;
        $siswa->nomor_hp =  $request->nomor_hp;
        $siswa->foto =  $request->foto;
        $siswa->ibu_kandung =  $request->ibu_kandung;
        $siswa->nik =  $request->nik;

     
        $siswa->save();
        return response()->json([
            'data' => $siswa,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Siswa::find($id);
        $guru->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}