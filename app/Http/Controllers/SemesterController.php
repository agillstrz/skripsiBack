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
        $semester = Semester::first();
        return response()->json($semester);
    }
    
    public function store(Request $request){
    $semester = Semester::create();

    return response()->json([
        'data' => $semester,
        'message'=>"data berhasil ditambahkan"
    ]);
}
}