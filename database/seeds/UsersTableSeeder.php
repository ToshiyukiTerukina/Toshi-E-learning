<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'first_name' => 'aaa',
            'last_name' => 'aaa',
            'email' => 'aaa@aaa.aaa',
            'password' => Hash::make('aaaaaa'),
        ]);
        $user->save();

        $user = new \App\User([
            'first_name' => 'bbb',
            'last_name' => 'bbb',
            'email' => 'bbb@bbb.bbb',
            'password' => Hash::make('bbbbbb'),
        ]);
        $user->save();

        $user = new \App\User([
            'first_name' => 'ccc',
            'last_name' => 'ccc',
            'email' => 'ccc@ccc.ccc',
            'password' => Hash::make('cccccc'),
        ]);
        $user->save();
    }
}
