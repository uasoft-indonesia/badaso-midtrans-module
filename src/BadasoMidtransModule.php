<?php

namespace Uasoft\Badaso\Module\Midtrans;

use Uasoft\Badaso\Module\Commerce\Abstracts\BadasoPayment as AbstractsBadasoPayment;
use Uasoft\Badaso\Module\Commerce\Interfaces\BadasoPayment;

class BadasoMidtransModule extends AbstractsBadasoPayment implements BadasoPayment
{
    protected $payment_slug = [
        'midtrans-credit-card-visa',
        'midtrans-credit-card-mastercard',
        'midtrans-credit-card-jcb',
        'midtrans-credit-card-amex',
        'midtrans-bca-va',
        'midtrans-bni-va',
        'midtrans-bri-va',
        'midtrans-echannel',
        'midtrans-permata-va',
        'midtrans-gopay',
        'midtrans-bca-klikbca',
        'midtrans-cimb-clicks',
        'midtrans-danamon-online',
        'midtrans-bri-epay',
        'midtrans-alfamart',
        'midtrans-indomaret',
        'midtrans-akulaku',
        'midtrans-shopeepay',
    ];

    protected $protected_payment_slug = [
        'midtrans-credit-card-visa',
        'midtrans-credit-card-mastercard',
        'midtrans-credit-card-jcb',
        'midtrans-credit-card-amex',
        'midtrans-bca-va',
        'midtrans-bni-va',
        'midtrans-bri-va',
        'midtrans-echannel',
        'midtrans-permata-va',
        'midtrans-gopay',
        'midtrans-bca-klikbca',
        'midtrans-cimb-clicks',
        'midtrans-danamon-online',
        'midtrans-bri-epay',
        'midtrans-alfamart',
        'midtrans-indomaret',
        'midtrans-akulaku',
        'midtrans-shopeepay',
    ];

    protected $accepted_payment = [
        'credit_card',
        'cimb_clicks',
        'bca_klikbca',
        'bca_klikpay',
        'bri_epay',
        'echannel',
        'permata_va',
        'bca_va',
        'bni_va',
        'bri_va',
        'other_va',
        'gopay',
        'indomaret',
        'danamon_online',
        'akulaku',
        'shopeepay',
    ];

    public function getPaymentSlug()
    {
        return $this->payment_slug;
    }

    public function getProtectedPaymentSlug()
    {
        return $this->protected_payment_slug;
    }

    public function getAcceptedPayment()
    {
        return $this->accepted_payment;
    }
}
