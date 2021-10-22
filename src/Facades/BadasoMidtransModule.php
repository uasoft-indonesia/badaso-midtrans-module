<?php

namespace Uasoft\Badaso\Module\Midtrans\Facades;

use Illuminate\Support\Facades\Facade;

class BadasoMidtransModule extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'badaso-midtrans-module';
    }
}
