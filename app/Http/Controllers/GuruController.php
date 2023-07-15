<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::latest()->paginate(20);
        return response()->json([
            'data' => $guru
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guru = Guru::create([
            'nama' => $request->nama,
            'nomorhp' => $request->nomorhp,
            'jenis_kelamin' => $request->jenis_kelamin
    
        ]);

        return response()->json([
            'data' => $guru,
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
        $guru = Guru::find($id);
        $guru->nama = $request->nama;
        $guru->nomorhp =  $request->nomorhp;
        $guru->jenis_kelamin =  $request->jenis_kelamin;
        $guru->save();
        return response()->json([
            'data' => $guru,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}