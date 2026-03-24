<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Get all permissions
        $permissions = Permission::all();

        // Give all permissions to admin role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }

        // Give limited permissions to seller role
        $sellerRole = Role::where('name', 'seller')->first();
        if ($sellerRole) {
            // Give seller specific permissions (you can customize these)
            $sellerPermissions = Permission::where('name', 'like', '%view%')->get();
            $sellerRole->givePermissionTo($sellerPermissions);
        }
    }
}
