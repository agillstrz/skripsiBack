<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBerita::get();
        return response()->json([
            'data' => $kategori
        ]);
    }
    // public function index()
    // {
    //     $kategori = KategoriBerita::latest()->paginate(5);
    //     return response()->json([
    //         'data' => $kategori
    //     ]);
    // }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kategori = KategoriBerita::create([
            'nama' => $request->nama,
    
        ]);

        return response()->json([
            'data' => $kategori,
            'message'=>"data berhasil ditambahkan"
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriBerita $kategoriBerita)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $kategori = KategoriBerita::find($id);
        $kategori->nama = $request->nama;
        $kategori->save();
        
        return response()->json([
            'data' => $kategori,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = KategoriBerita::find($id);
        $berita->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}