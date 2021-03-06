<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

use App\User;
use App\Category;
use App\Type;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::updateOrcreate(['name' => 'admin']);
        $customerservice = Role::updateOrcreate(['name' => 'customerservice']);
        $salesRole = Role::updateOrcreate(['name' => 'sales']);
        $purchaserRole = Role::updateOrcreate(['name' => 'purchaser']);
        

        $user = User::updateOrcreate(['email'=>'admin@example.com'],['name'=>'Super Admin',
                                                					 'email'=>'admin@example.com',
                                                					 'password'=>Hash::make('password')]);

        $user->assignRole($superAdminRole);

      
        // Create Default Permissions
        $adminDashboardPermission = Permission::updateOrcreate(['name' => 'admin.dashboard']);
        $adminProfilePermission = Permission::updateOrcreate(['name' => 'admin.profile.index']);
        $adminUpdateProfilePermission = Permission::updateOrcreate(['name' => 'admin.profile.store']);
       
        // Assign default permission to vepaar
        $customerservice->givePermissionTo($adminDashboardPermission);
        $customerservice->givePermissionTo($adminProfilePermission);
        $customerservice->givePermissionTo($adminUpdateProfilePermission);

        // Assign default permission to vepaar
        $salesRole->givePermissionTo($adminDashboardPermission);
        $salesRole->givePermissionTo($adminProfilePermission);
        $salesRole->givePermissionTo($adminUpdateProfilePermission);

        // Assign default permission to vepaar
        $purchaserRole->givePermissionTo($adminDashboardPermission);
        $purchaserRole->givePermissionTo($adminProfilePermission);
        $purchaserRole->givePermissionTo($adminUpdateProfilePermission);
  
    }
}
