<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Models\System\Users\UserSettings;
use Database\Seeders\RolePermissionSeeder;
use App\Models\System\Settings\System\LayerOnePermission;
use App\Models\System\Settings\System\LayerOneGroupNamePermissions;
use App\Models\System\Users\User;
use App\Traits\GenerateSlugKey;

class DatabaseSeeder extends Seeder
{
    use GenerateSlugKey;

    private const TEST_USER_DATA = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            $user = $this->createTestUser();
            // $this->createGroupsAndPermissions($user);
            $this->callAdditionalSeeders();
            $this->createUserSettings($user);
            $this->createTheme($user);
            Artisan::call('translations:cache');
        });
    }

    private function createTheme($user): void
    {
        $themes = [
            ['name' => 'light', 'slug' => 'light'],
            ['name' => 'dark', 'slug' => 'dark'],
        ];

        foreach ($themes as $theme) {
            $user->theme()->firstOrCreate($theme);
        }
    }

    private function createTestUser(): User
    {
        return User::firstOrCreate(
            ['email' => self::TEST_USER_DATA['email']],
            [
                'name' => self::TEST_USER_DATA['name'],
                'password' => Hash::make(self::TEST_USER_DATA['password']),
            ]
        );
    }

    private function createGroupsAndPermissions(User $user): void
    {
        $groups = $this->createPermissionGroups($user);
        $this->createPermissions($user, $groups['system']);
    }

    private function createPermissionGroups(User $user): array
    {
        $groupsData = [
            'system' => [
                'name' => 'system',
                'slug' => 'system',
                'description' => 'Core system administration and configuration',
            ],
            'sales' => [
                'name' => 'sales',
                'slug' => 'sales',
                'description' => 'Sales management and customer relations',
            ],
            'purchase' => [
                'name' => 'purchase',
                'slug' => 'purchase',
                'description' => 'Purchase and procurement management',
            ],
        ];

        $createdGroups = [];

        foreach ($groupsData as $key => $groupData) {
            $createdGroups[$key] = LayerOneGroupNamePermissions::firstOrCreate(
                ['name' => $groupData['name'], 'user_id' => $user->id],
                array_merge($groupData, ['user_id' => $user->id])
            );
        }

        return $createdGroups;
    }


    private function createPermissions(User $user, LayerOneGroupNamePermissions $systemGroup): void
    {
        $permissionsData = [
            [
                'name' => 'clients',
                'slug' => 'clients',
                'description' => 'Manage clients and their data',
            ],
            [
                'name' => 'resellers',
                'slug' => 'resellers',
                'description' => 'Manage resellers and their data',
            ],
            [
                'name' => 'users',
                'slug' => 'users',
                'description' => 'Manage users and their permissions',
            ],
            [
                'name' => 'reseller_packages',
                'slug' => 'reseller-packages',
                'description' => 'Manage resellers and their data',
            ],
            [
                'name' => 'client_packages',
                'slug' => 'client-packages',
                'description' => 'Manage packages and their data',
            ],
            [
                'name' => 'settings',
                'slug' => 'settings',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'usertypes',
                'slug' => 'usertypes',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'currencies',
                'slug' => 'currencies',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'permissions',
                'slug' => 'permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'layer_one_permissions',
                'slug' => 'layer-one-permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'status',
                'slug' => 'status',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'client_status',
                'slug' => 'client-status',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'max_users',
                'slug' => 'max-users',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'max_clients',
                'slug' => 'max-clients',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'durations',
                'slug' => 'durations',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'ports',
                'slug' => 'ports',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'storage',
                'slug' => 'storage',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'dbtypes',
                'slug' => 'dbtypes',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'max_clients',
                'slug' => 'max-clients',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'layer_one_group_name_permissions',
                'slug' => 'layer-one-group-name-permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'layer_one_permissions',
                'slug' => 'layer-one-permissions',
                'description' => 'System settings and configurations',
            ],
            [
                'name' => 'languages',
                'slug' => 'languages',
            ],
            [
                'name' => 'keys',
                'slug' => 'keys',
                'description' => 'Custom permissions for specific use cases',
            ],
            [
                'name' => 'translations',
                'slug' => 'translations',
                'description' => 'Manage translations for the application',
            ],
            [
                'name' => 'font_scale',
                'slug' => 'font-scale',
                'description' => 'Manage font scale settings for the application',
            ],
            [
                'name' => 'dbtemplate',
                'slug' => 'dbtemplate',
                'description' => 'Manage client database templates',
            ],
            [
                'name' => 'reseller_status_history',
                'slug' => 'reseller-status-history',
                'description' => 'Manage reseller status history',
            ],
            [
                'name' => 'client_status_history',
                'slug' => 'client-status-history',
                'description' => 'Manage client status history',
            ],
            [
                'name' => 'logs',
                'slug' => 'logs',
                'description' => 'Manage client status history',
            ],
            [
                'name' => 'roles',
                'slug' => 'roles',
                'description' => 'Manage client status history',
            ],
        ];

        foreach ($permissionsData as $permissionData) {
            LayerOnePermission::firstOrCreate(
                [
                    'name' => $permissionData['name'],
                    'slug' => $permissionData['slug'],
                    'layer_one_group_id' => $systemGroup->id,
                    'user_id' => $user->id,
                ],
                array_merge($permissionData, [
                    'layer_one_group_id' => $systemGroup->id,
                    'user_id' => $user->id,
                ])
            );
        }
    }

    private function createUserSettings(User $user): void
    {
        UserSettings::firstOrCreate(
            ['user_id' => $user->id],
            [
                'font_scale' => 'medium',
                'theme' => 'dark',
                'language_id' => 3,
            ]
        );
    }

    private function callAdditionalSeeders(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            TranslationsSeeder::class,
        ]);
    }
}
