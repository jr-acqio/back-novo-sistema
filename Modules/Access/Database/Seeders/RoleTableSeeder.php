<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Access\Entities\Permission;
use Modules\Access\Entities\Role;
use Modules\Access\Entities\User;
use Modules\Access\Validators\PermissionValidator;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Usuário administrador'; // optional
        $admin->description  = 'Usuário com todas as permissões.'; // optional
        $admin->save();

        $user = User::where('name', '=', 'Lucas Dantas')->first();
        $user->attachRole($admin);

        $deletarUsuario = new Permission();
        $deletarUsuario->name = 'delete-user';
        $deletarUsuario->display_name = 'Deleta usuário.';
        $deletarUsuario->description = 'Poderá deletar algum usuário.';
        $deletarUsuario->save();

        $admin->attachPermission($deletarUsuario);
    }


}
