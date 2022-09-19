<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('users')->delete();

        DB::collection('users')->insert(['username' => 'test', 'password' => Hash::make('test')]);
        // $newUser = new User();
        // $newUser->username = 'test';
        // $newUser->password = 'test';
        // $newUser->save();
    }
}
