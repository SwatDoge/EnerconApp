<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(20)
            ->create();

            DB::table('users')->insert([
                ['name' => 'max',
                 'email' => 'maxhoekstra@hotmail.com',
                'password' => Hash::make('Welkom123'),
                'phonenumber' => '06-21337114'],
            ]);
    }
}
