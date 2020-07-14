<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PermissionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Delete un used permissions
         */

        /*
         * Admin Role
         */
        Role::updateOrCreate([
            'name' => 'admin',
        ], [
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin Role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Role::updateOrCreate([
            'name' => 'custom',
        ], [
            'name' => 'custom',
            'display_name' => 'Custom',
            'description' => 'Custom Role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );

        /*
         * Admin Permission
         */
        //Permission
        Permission::updateOrCreate([
            'name' => 'admin-admins-create',
        ], [
            'name' => 'admin-admins-create',
            'display_name' => 'Admin Create',
            'description' => 'Admin Create',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-admins-read',
        ], [
            'name' => 'admin-admins-read',
            'display_name' => 'Admin Read',
            'description' => 'Admin Read',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-admins-update',
        ], [
            'name' => 'admin-admins-update',
            'display_name' => 'Admin Update',
            'description' => 'Admin Update',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-admins-delete',
        ], [
            'name' => 'admin-admins-delete',
            'display_name' => 'Admin Delete',
            'description' => 'Admin Delete',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );

        Permission::updateOrCreate([
            'name' => 'admin-permission-groups-create',
        ], [
            'name' => 'admin-permission-groups-create',
            'display_name' => 'Permission Group Create',
            'description' => 'Permission Group Create',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-permission-groups-read',
        ], [
            'name' => 'admin-permission-groups-read',
            'display_name' => 'Permission Group Read',
            'description' => 'Permission Group Read',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-permission-groups-update',
        ], [
            'name' => 'admin-permission-groups-update',
            'display_name' => 'Permission Group Update',
            'description' => 'Permission Group Update',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );
        Permission::updateOrCreate([
            'name' => 'admin-permission-groups-delete',
        ], [
            'name' => 'admin-permission-groups-delete',
            'display_name' => 'Permission Group Delete',
            'description' => 'Permission Group Delete',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        );


        //end
    }
}
