<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            [
                "role" => 1,
                "name" => "Demo Admin",
                "email" => "admin@demo.com",
                "email_verified_at" => Carbon::now(),
                "password" => Hash::make('demoadmin'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "role" => 2,
                "name" => "Demo User",
                "email" => "user@demo.com",
                "email_verified_at" => Carbon::now(),
                "password" => Hash::make('demouser'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ]);
    }
}
