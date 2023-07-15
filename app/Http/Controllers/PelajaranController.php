<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelajaran = Pelajaran::latest()->paginate(5);
        return response()->json([
            'data' => $pelajaran
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pelajaran = Pelajaran::create([
            'nama' => $request->nama,
            'kkm' => $request->kkm
        ]);

        return response()->json([
            'data' => $pelajaran,
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
        $pelajaran = Pelajaran::find($id);
        $pelajaran->nama = $request->nama;
        $pelajaran->kkm = $request->kkm;

        $pelajaran->save();
        return response()->json([
            'data' => $pelajaran,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelajaran = Pelajaran::find($id);
        $pelajaran->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}