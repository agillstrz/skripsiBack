<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::where('kelas_id', $request->kelas_id)->where('semester_id', $request->semester)->with(['siswa','semester'])->get();
        return response()->json($pembayaran);
    }
    public function detailPembayaran($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->latest()->paginate(5);
        return response()->json([
            'data' => $pembayaran
        ]);
    }

    public function pembayaranKelas(Request $request)
    {
        $pembayaran = Pembayaran::with('siswa')->latest()->paginate(5);
        return response()->json([
            'data' => $pembayaran
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pembayaran = Pembayaran::create([
            'semester_id' => $request->semester_id,
            'siswa_id,' => $request->siswa_id,
            'tanggal_bayar,' => $request->tanggal_bayar,
            'metode,' => $request->metode,
            'jumlah,' => $request->jumlah,
            'status,' => $request->status,
        ]);

        return response()->json([
            'data' => $pembayaran,
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
        $pembayaran = Pembayaran::find($id);
        $pembayaran->semester_id = $request->semester_id;
        $pembayaran->tanggal_bayar = $request->tanggal_bayar;
        $pembayaran->metode = $request->metode;
        $pembayaran->jumlah = $request->jumlah;
        $pembayaran->status = $request->status;


        $pembayaran->save();
        return response()->json([
            'data' => $pembayaran,
            'message'=>"data berhasil diperbarui"
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
        return response()->json([
            'Message' => "produk berhasil dihapus"
        ]);
    }
}