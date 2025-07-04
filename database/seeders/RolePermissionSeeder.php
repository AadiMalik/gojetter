<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'list users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'super admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->givePermissionTo(['view dashboard']);

        // Optional: create another role
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(['list users', 'edit users']);
    }
}
