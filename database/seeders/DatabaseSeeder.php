<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Berita;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Set locale ke Indonesia

       

for ($i = 0; $i < 20; $i++) {
    $randomNumber = $faker->numberBetween(10000000, 99999999);
    $randomNumber .= '23'; // Menambahkan 23 di akhir
    $namaOrang = $faker->unique()->firstName;
    $siswa = new Siswa;
    $siswa->nama = $namaOrang;
    $siswa->nim = $randomNumber;
    $siswa->email = $namaOrang . '@kujang.com';
    $siswa->kelas_id =3;
    $siswa->save();

    $user = User::create([
        'name' => $namaOrang,
        'email' => $namaOrang . '@kujang.com',
        'password' => bcrypt('MyPassword321')
    ]);
}



        // \App\Models\User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@kujang.com',
        //     'password' => bcrypt('AdminKujang321'),
        //     'role' => 1,
        // ]);

        // $siswa = new Siswa();
        // $siswa->nama = 'admin';
        // $siswa->nim = '1322337';
        // $siswa->email = 'admin@kujang.com';
        // $siswa->kelas_id = 1;
        // $siswa->save();
    }
}