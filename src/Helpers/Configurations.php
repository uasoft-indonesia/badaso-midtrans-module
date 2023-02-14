<?php

namespace Uasoft\Badaso\Module\Midtrans\Helpers;

use Uasoft\Badaso\Models\Configuration;

class Configurations
{
    public static function index()
    {
        $configurations = Configuration::where('group', 'midtransModule')->get();
        foreach ($configurations as $key => $config) {
            if ($config->key == 'midtransMerchantId') {
                $merchantId = $config->value;
            }
            if ($config->key == 'midtransClientKey') {
                $clientKey = $config->value;
            }
            if ($config->key == 'midtransServerKey') {
                $serverKey = $config->value;
            }
            if ($config->key == 'paymentTypeByBadaso') {
                $paymentType = $config->value;
            }


        }

        $title = (object)[
            "merchantId" => $merchantId,
            "clientKey" => $clientKey,
            "serverKey" => $serverKey,
            "paymentType" =>  $paymentType
        ];
        return $title;
    }
}
