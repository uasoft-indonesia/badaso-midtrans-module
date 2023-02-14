<?php

namespace Database\Seeders\Badaso\Midtrans;

use Illuminate\Database\Seeder;

class BadasoMidtransModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MidtransMenusSeeder::class,
            MidtransFixedMenuItemSeeder::class,
            MidtransPermissionsSeeder::class,
            MidtransRolePermissionsSeeder::class,
            MidtransSiteManagementSeeder::class,
            MidtransPaymentOptionsSeeder::class,
            MidtransKeyConfigurationsSeeder::class,
        ]);
    }
}
