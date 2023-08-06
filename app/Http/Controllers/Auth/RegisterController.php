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
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'nim' => [ 'required', 'string','min:5', 'max:12', Rule::unique(Siswa::class),],
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
  

        
 
    

    }
    public function TambahSiswBaru(Request $request)
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

            $jadwal = Jadwal::with(['kelas', 'pelajaran'])
            ->where('kelas_id', $request->kelas_id)
            ->latest()
            ->get();
            $uniqueJadwal = $jadwal->unique(function ($item) {
            return $item->pelajaran_id;
        });


            $cekNilaiSemester = Nilai::where('kelas_id', $request->kelas_id)->where('semester_id', $request->semester_id)->exists();
            
            if($cekNilaiSemester){
                $pembayaran =  Pembayaran::create([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $siswa->kelas_id,
                    'semester_id' => $request->semester_id,
                    'jumlah' => 250000,
                ]);

                foreach ($uniqueJadwal as $pelajaran) {
                  Nilai::create([
                    'pelajaran_id' => $pelajaran->pelajaran_id,
                    'semester_id' => $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswa->id,
                    'nilai' => 0,
                    'keterangan' => ""
                ]);
    
                NilaiUjian::create([
                    'pelajaran_id' => $pelajaran->pelajaran_id,
                    'semester_id' =>  $request->semester_id,
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswa->id,
                    'nilai' => 0,
                    'keterangan' => ""
                ]); 
            }
            }
    
            return response()->json([
                'user' => $user ,
                'siswa' => $siswa,
            ]);
    }

    public function ubahPassword(Request $request){
        $user = User::find(Auth::id());
        
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        if (!Hash::check($request->current_password, $user->getAuthPassword())) {
            throw ValidationException::withMessages(['current_password' => 'Password lama tidak cocok']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        
        
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        return response()->json(['message' => 'Password berhasil diubah'], 200);
    }
}