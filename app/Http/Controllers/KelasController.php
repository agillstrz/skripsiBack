<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('jenjang')->latest()->paginate(10);
        return response()->json([
            'data' => $kelas
        ]);

        
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kelas = Kelas::create([
            'nama' => $request->nama,
            'jenjang_id' => $request->jenjang_id
    
        ]);

        return response()->json([
            'data' => $kelas,
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
        $kelas = Kelas::find($id);
        $kelas->nama = $request->nama;
        $kelas->jenjang_id = $request->jenjang_id;
        
        $kelas->save();
        return response()->json([
            'data' => $kelas,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Kelas::find($id);
        $guru->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}