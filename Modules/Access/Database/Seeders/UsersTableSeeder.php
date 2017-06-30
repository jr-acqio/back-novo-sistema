<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Access\Entities\Role;
use Modules\Access\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Como já está criado no banco, vamos apenas adicionar permissões
        $u = User::find(1);
        $u->attachRole(Role::where('name','admin')->first());
    }
}
