<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{

    const DISABLE_FOREIDN_KEY = 'SET FOREIGN_KEY_CHECKS=0;';
    const ENABLE_FOREIDN_KEY = 'SET FOREIGN_KEY_CHECKS=1;';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(self::DISABLE_FOREIDN_KEY);
        Role::truncate();
        Permission::truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::statement(self::ENABLE_FOREIDN_KEY);

        $role = Role::create(['name' => config('authorization.roles.super-admin')]);
        $permission = Permission::create(['name' => config('authorization.permissions.view-admin')]);
        $role->givePermissionTo($permission);
    }
}
