<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find only admin and seller roles (super_admin removed)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $sellerRole = Role::firstOrCreate(['name' => 'seller']);

        // Assign admin role to the first user (admin user)
        $adminUser = User::find(1);
        if ($adminUser && !$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }
    }
}
