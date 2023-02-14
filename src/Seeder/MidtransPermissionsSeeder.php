<?php

namespace Database\Seeders\Badaso\Midtrans;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Permission;

class MidtransPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_midtrans_configurations',
            'edit_midtrans_configurations',
            'browse_midtrans_payments',
            'edit_midtrans_payments',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key' => $key,
                'table_name' => null,
            ]);
        }
    }
}
