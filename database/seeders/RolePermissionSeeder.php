<?php

namespace Database\Seeders;

use App\Models\System\Users\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'dashboard' => [
                'view'
            ],
            'products' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'services' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'clients' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'hostings' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'users' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'roles' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
            'permissions' => [
                'view',
                'create',
                'edit',
                'delete'
            ],
        ];

        foreach ($permissions as $group => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission . '_' . $group,
                    'group' => $group
                ]);
            }
        }

        // Create roles and assign existing permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['view_users']);

        // Assign role and permissions to user
        $user = User::first();
        $user->assignRole('admin');
        $user->givePermissionTo(Permission::get()->pluck('name'));
    }
}
