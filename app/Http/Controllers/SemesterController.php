<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index(){
        $semester = Semester::all();
        return response()->json($semester);
    }
    public function semesterSekarang(){
        $semester = Semester::latest()->first();
        return response()->json($semester);
    }
    
    public function update($id, Request $request){
        $semester = Semester::find($id);
        $semester->nama = $request->nama;
        $semester->save();
        return response()->json($semester);
    }
    
    public function store(Request $request){
    $semester = Semester::create([
        'nama' => $request->nama,
    ]);
    return response()->json([
        'data' => $semester,
        'message'=>"data berhasil ditambahkan"
    ]);
}
}