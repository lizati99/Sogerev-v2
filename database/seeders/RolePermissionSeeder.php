<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all the roles
        $permissions = Permission::pluck('id')->toArray();

        // get roles
        $superAdmin = Role::where('libelle', 'super administrateur')->first();
        $admin = Role::where('libelle', 'administrateur')->first();
        $commercial = Role::where('libelle', 'commercial')->first();
        $editor = Role::where('libelle', 'éditeur')->first();


        if ($superAdmin) {
            foreach ($permissions as $permissionId) {
                RolePermission::create([
                    'role_id' => $superAdmin->id,
                    'permission_id' => $permissionId
                ]);
            }
        }


        $this->attachPermissions($admin, [1, 2, 4]); // manage users, view reports, access dashboard
        $this->attachPermissions($commercial, [3, 4]); // manage sales, access dashboard
        $this->attachPermissions($editor, [2]); // view reports

        // Role::factory(10)->create();
     }

     private function attachPermissions($role, array $permissionIds)
     {
         if ($role) {
             foreach ($permissionIds as $permissionId) {
                 RolePermission::create([
                     'role_id' => $role->id,
                     'permission_id' => $permissionId
                 ]);
             }
         }
     }


}
