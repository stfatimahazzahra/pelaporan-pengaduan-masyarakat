<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ([
            [
                'nama_petugas' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('secret'),
                'telp' => '081300000000',
                'level' => 'admin',
            ]
        ]);
        foreach($users as $user) {
            Petugas::create($user);
        }
    }
}
