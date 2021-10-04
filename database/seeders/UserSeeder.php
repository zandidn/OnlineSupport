<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name'         => 'Ali Karimi',
            'email'        => 'ali@gmail.com',
            'password'     => bcrypt('123456'),
            'is_supporter' => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
        User::firstOrCreate([
            'name'         => 'Donya Zandi',
            'email'        => 'zandi.dn@gmail.com',
            'password'     => bcrypt('123456'),
            'is_supporter' => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
        User::factory(10)->create();
    }
}
