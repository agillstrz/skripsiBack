<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenjang = Jenjang::latest()->paginate(5);
        return response()->json([
            'data' => $jenjang
        ]);

        
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenjang = Jenjang::create([
            'nama' => $request->nama
    
        ]);

        return response()->json([
            'data' => $jenjang,
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
        $jenjang = Jenjang::find($id);
        $jenjang->nama = $request->nama;
        
        $jenjang->save();
        return response()->json([
            'data' => $jenjang,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenjang = Jenjang::find($id);
        $jenjang->delete();
        return response()->json([
            'Message' => "data berhasil dihapus"
        ]);
    }
}