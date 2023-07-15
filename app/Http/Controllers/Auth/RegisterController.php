<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\NilaiUjian;
use App\Models\Pembayaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function Register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'nim' => [ 'required', 'string', 'max:12', Rule::unique(Siswa::class),],
            'kelas_id' => ['required'],
            'password' => ['required','min:8'],
        ]);


            $siswa = new Siswa;
            $siswa->nama = $request->name;
            $siswa->nim = $request->nim;
            $siswa->email = $request->email;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->save();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
    
            $token = $user->createToken('myAppToken');
    
            return response()->json([
                'user' => $user ,
                'siswa' => $siswa,
            ]);
  

        
    // $jadwal = Jadwal::with(['kelas', 'pelajaran'])
    //     ->where('kelas_id', $request->kelas_id)
    //     ->latest()
    //     ->get();

    //     $uniqueJadwal = $jadwal->unique(function ($item) {
    //     return $item->pelajaran_id;
    // });


    // $semester = Semester::all();

    // foreach($semester as $sem){
    //     $pembayaran =  Pembayaran::create([
    //         'siswa_id' => $siswa->id,
    //         'semester_id' => $sem->id,
    //     ]);

    // foreach ($uniqueJadwal as $pelajaran) {

    
    //         $nilai =  Nilai::create([
    //             'pelajaran_id' => $pelajaran->pelajaran_id,
    //             'semester_id' => $sem->id,
    //             'kelas_id' => $request->kelas_id,
    //             'siswa_id' => $siswa->id,
    //             'nilai' => 0,
    //             'keterangan' => ""
    //         ]);

    //         $nnilaiUjian =  NilaiUjian::create([
    //             'pelajaran_id' => $pelajaran->pelajaran_id,
    //             'semester_id' =>  $sem->id,
    //             'kelas_id' => $request->kelas_id,
    //             'siswa_id' => $siswa->id,
    //             'nilai' => 0,
    //             'keterangan' => ""
    //         ]);
    //     }
        
    // }
     
    

    }
}