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
            if ($config->key == 'midtransClientId') {
                $clientId = $config->value;
            }
            if ($config->key == 'midtransServerId') {
                $serverId = $config->value;
            }

        }

        $title = (object)[
            "merchantId" => $merchantId,
            "clientId" => $clientId,
            "serverId" => $serverId
        ];
        return $title;
    }
}
