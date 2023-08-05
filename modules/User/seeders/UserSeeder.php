<?php

namespace Modules\User\seeders;

use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
   
       for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'name' =>  $faker->name,
                'email' =>  $faker->email,
                'password' =>  Hash::make(11111111),
                'group_id' => 1,
                'email_verified_at' => now(),
                'created_at'=> now(),
                'updated_at'=> now()
            ]);
        }
    }
}