<?php

namespace Database\Seeders\Badaso\Midtrans;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Models\Permission;
use Uasoft\Badaso\Models\Role;
use Uasoft\Badaso\Models\RolePermission;

class MidtransRolePermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @throws Exception
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $administrator = Role::where('name', 'administrator')->firstOrFail();

            $permissions = Permission::all();

            if (!is_null($administrator)) {
                foreach ($permissions as $row) {
                    $role_permission = RolePermission::where('role_id', $administrator->id)
                            ->where('permission_id', $row->id)
                            ->first();
                    if (is_null($role_permission)) {
                        $role_permission = new RolePermission();
                        $role_permission->role_id = $administrator->id;
                        $role_permission->permission_id = $row->id;
                        $role_permission->save();
                    }
                }
            }

            DB::commit();
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            DB::rollBack();
        }
    }
}
