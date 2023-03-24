<?php

namespace Uasoft\Badaso\Module\Midtrans\Services;

use Illuminate\Support\Facades\App;
use Midtrans\Config;
use Uasoft\Badaso\Module\Midtrans\Helpers\Configurations;

class Midtrans
{
    public $clientKey;
    public $serverKey;
    public $isProduction;
    public $isSanitized;
    public $is3ds;

    public function __construct()
    {
        $config = Configurations::index();

        if (!empty(env('MIDTRANS_CLIENT_KEY'))) {
            $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        } else {
            $this->clientKey = $config->clientKey;
        }
        if (!empty(env('MIDTRANS_SERVER_KEY'))) {
            $this->serverKey = env('MIDTRANS_SERVER_KEY');
        } else {
            $this->serverKey = $config->serverKey;
        }

        if (App::environment('production')) {
            $this->isProduction = true;
        } else {
            $this->isProduction = false;
        }

        $this->isSanitized = true;
        $this->is3ds = true;
        $this->_configureMidtrans();
    }

    public function _configureMidtrans()
    {
        Config::$clientKey = $this->clientKey;
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }
}
