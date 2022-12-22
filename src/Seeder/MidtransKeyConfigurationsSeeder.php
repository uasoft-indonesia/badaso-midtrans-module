<?php

namespace Database\Seeders\Badaso\Midtrans;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Models\Configuration;

class MidtransKeyConfigurationsSeeder extends Seeder
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
            $settings = [
                0 => [
                    'key'          => 'midtransMerchantId',
                    'display_name' => 'Midtrans Merchant Id',
                    'value'        => 'G155833803',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 1,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
                1 => [
                    'key'          => 'midtransClientId',
                    'display_name' => 'Midtrans Client Id',
                    'value'        => 'SB-Mid-client-nK12_c7iZC8eBTNB',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 2,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
                2 => [
                    'key'          => 'midtransServerId',
                    'display_name' => 'Midtrans Server Id',
                    'value'        => 'SB-Mid-server-KCm4xDJxRFjMbRqn1ZxB2ChZ',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 3,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
               

            ];

            foreach ($settings as $key => $value) {
                Configuration::where('key', $value['key'])->delete();
                Configuration::create($value);
            }

            DB::commit();
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            DB::rollBack();
        }
    }
}
