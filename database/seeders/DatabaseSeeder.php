<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::table('roles')->insert([
            ['name_role'=>'admin'],
            ['name_role'=>'customer'],
        ]);
        DB::table('users')->insert([
            ['fullname'=>'admin','email'=>'admin@waybucks.local','password'=>Hash::make('admin'),'profile'=>'','role_id'=>1],
        ]);
    }
}
