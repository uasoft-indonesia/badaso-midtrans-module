<?php

namespace Database\Seeders\Badaso\Midtrans;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Models\Configuration;

class MidtransSiteManagementSeeder extends Seeder
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
            $settings = [];

            foreach ($settings as $key => $value) {
                Configuration::where('key', $value['key'])->delete();
                Configuration::create($value);
            }
            DB::commit();
        } catch (Exception $e) {
            throw new Exception('Exception occur ' . $e);
            DB::rollBack();
        }
    }
}
