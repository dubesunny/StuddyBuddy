<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin','teacher','student'];
        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        $permissions = [
            [
                'name' => 'add_user',
                'module_name' => 'user',
            ],
            [
                'name' => 'edit_user',
                'module_name' => 'user'
            ],
            [
                'name' => 'delete_user',
                'module_name' => 'user'
            ],
            [
                'name' => 'view_user',
                'module_name' => 'user'
            ],
            [
                'name' => 'add_course',
                'module_name' => 'course'
            ],
            [
                'name' => 'edit_course',
                'module_name' => 'course'
            ],
            [
                'name' => 'delete_course',
                'module_name' => 'course'
            ],
            [
                'name' => 'view_course',
                'module_name' => 'course'
            ]
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }

        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
    }
}
