<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // $path = 'db/laravel_payroll.sql';
        // DB::unprepared(file_get_contents($path));

        $jabatans = [
            [
                'nama_jabatan' => 'Staff Payroll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $tambahans = [
            'nama_tambahan' => 'BPJS',
            'persentase_tambahan' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $user =
            [
                [
                    'name' => 'staff payroll',
                    'email' => 'staffpayroll@gmail.com',
                    'password' => bcrypt('12345678'),
                    'jabatan_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'spv payroll',
                    'email' => 'spvpegawai1@gmail.com',
                    'password' => bcrypt('12345678'),
                    'jabatan_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),  
                ],
                [
                    'name' => 'pegawai kontrak',
                    'email' => 'pegawai1kontrak@gmail.com',
                    'password' => bcrypt('12345678'),
                    'jabatan_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),  
                ],
                [
                    'name' => 'pegawai hl',
                    'email' => 'pegawai1hl@gmail.com',
                    'password' => bcrypt('12345678'),
                    'jabatan_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),  
                ],
        ];

        $detail_user = [
            [
                'nama' => 'spv payroll',
                'tempat_lahir' => 'gresik',
                'tanggal_lahir' => '1999-01-01',
                'jenis_kelamin' => 'pria',
                'id_user' => 2,
                'status' => 'tetap',
                'gaji_pokok' => 5000000,
                'tunjangan' => 500000,
                'tanggal_masuk' => '2021-01-01',
                'id_tambahan'=> 1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nama' => 'pegawai kontrak',
                'tempat_lahir' => 'gresik',
                'tanggal_lahir' => '1999-01-01',
                'jenis_kelamin' => 'pria',
                'id_user' => 3,
                'status' => 'tetap',
                'gaji_pokok' => 4500000,
                'tunjangan' => 250000,
                'tanggal_masuk' => '2022-01-01',
                'id_tambahan'=> 1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'nama' => 'pegawai hl',
                'tempat_lahir' => 'gresik',
                'tanggal_lahir' => '1999-01-01',
                'jenis_kelamin' => 'pria',
                'id_user' => 4,
                'status' => 'kontrak',
                'gaji_pokok' => 3000000,
                'tunjangan' => 150000,
                'tanggal_masuk' => '2023-01-01',
                'id_tambahan'=> 1,
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        
        ];

        DB::table('tambahans')->insert($tambahans);
        DB::table('jabatans')->insert($jabatans);
        DB::table('users')->insert($user);  
        DB::table('detail_users')->insert($detail_user);
    }
}
