<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=> 'Junior Paiva',
            'email'=>'joselito.junior@esfera5.com.br',
            'password' => Hash::make('password')
            ]);
    }
}
