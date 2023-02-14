<?php

namespace Database\Seeders\Badaso\Midtrans;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Models\Configuration;

class MidtransConfigurationsSeeder extends Seeder
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
                    'value'        => '',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 1,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
                1 => [
                    'key'          => 'midtransClientKey',
                    'display_name' => 'Midtrans Client Key',
                    'value'        => '',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 2,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
                2 => [
                    'key'          => 'midtransServerKey',
                    'display_name' => 'Midtrans Server Key',
                    'value'        => '',
                    'details'      => '',
                    'type'         => 'text',
                    'order'        => 3,
                    'group'        => 'midtransModule',
                    'can_delete'   => 0,
                ],
                3 => [
                    'key' => 'paymentTypeByBadaso',
                    'display_name' => 'Payment Type by Badaso',
                    'value' => '0',
                    'details' => '',
                    'type' => 'switch',
                    'order' => 4,
                    'group' => 'midtransModule',
                    'can_delete' => 0,
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
