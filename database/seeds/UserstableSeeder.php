<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'admin',
            'password'=>bcrypt('admin'),
            'email'=>'admin@gmail.com',
            'admin'=>1,
            'avatar'=>url('/avatars/avatar.png')
        ]);

        App\User::create([
            'name'=>'arabian',
            'password'=>bcrypt('arabian'),
            'email'=>'arabian@gmail.com',
            'avatar'=>asset('/avatars/download.png')
        ]);
    }
}
