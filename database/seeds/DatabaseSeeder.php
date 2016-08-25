<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
        'name'=>'admin',
        'email'=>'web.steamflower@gmail.com',
        'password'=>13747('pass'),
]);
    }
}
