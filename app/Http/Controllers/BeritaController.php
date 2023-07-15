<?php

namespace App\Http\Controllers;

use App\Models\Berita;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::with('kategori')->get();
        return response()->json([
            'data' => $berita
        ]);

   

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $berita = Berita::create([
            'kategori_id' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto
    
        ]);

        return response()->json([
            'data' => $berita,
            'message'=>"data berhasil ditambahkan"
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }



    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        $berita->kategori_id = $request->kategori;
        $berita->judul =  $request->judul;
        $berita->deskripsi =  $request->deskripsi;
        $berita->foto =  $request->foto;
        $berita->save();
        return response()->json([
            'data' => $berita,
            'message'=>"data berhasil diperbarui"
        ]); 
        
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        $berita->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}