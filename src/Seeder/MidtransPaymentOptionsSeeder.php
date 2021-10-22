<?php

namespace Database\Seeders\Badaso\Midtrans;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Models\Menu;
use Uasoft\Badaso\Module\Commerce\Models\Payment;
use Uasoft\Badaso\Module\Commerce\Models\PaymentOption;

class MidtransPaymentOptionsSeeder extends Seeder
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
            $payments = [
                'card' => [
                    0 => [
                        'slug' => 'midtrans-credit-card-visa',
                        'name' => 'Visa',
                        'description' => null,
                        'image' => 'files/shares/visa.svg',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                    1 => [
                        'slug' => 'midtrans-credit-card-mastercard',
                        'name' => 'Mastercard',
                        'description' => null,
                        'image' => 'files/shares/mastercard.svg',
                        'is_active' => 0,
                        'order' => 2,
                    ],
                    2 => [
                        'slug' => 'midtrans-credit-card-jcb',
                        'name' => 'JCB',
                        'description' => null,
                        'image' => 'files/shares/jcb.svg',
                        'is_active' => 0,
                        'order' => 3,
                    ],
                    3 => [
                        'slug' => 'midtrans-credit-card-amex',
                        'name' => 'American Express',
                        'description' => null,
                        'image' => 'files/shares/american_express.svg',
                        'is_active' => 0,
                        'order' => 4,
                    ],
                ],
                'bank-transfer' => [
                    0 => [
                        'slug' => 'midtrans-bca-va',
                        'name' => 'BCA Virtual Account',
                        'description' => null,
                        'image' => 'files/shares/bca.svg',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                    1 => [
                        'slug' => 'midtrans-bni-va',
                        'name' => 'BNI Virtual Account',
                        'description' => null,
                        'image' => 'files/shares/bni.svg',
                        'is_active' => 0,
                        'order' => 2,
                    ],
                    2 => [
                        'slug' => 'midtrans-bri-va',
                        'name' => 'BRI Virtual Account',
                        'description' => null,
                        'image' => 'files/shares/bri.svg',
                        'is_active' => 0,
                        'order' => 3,
                    ],
                    3 => [
                        'slug' => 'midtrans-echannel',
                        'name' => 'Mandiri Bill Payment',
                        'description' => null,
                        'image' => 'files/shares/mandiri.svg',
                        'is_active' => 0,
                        'order' => 4,
                    ],
                    4 => [
                        'slug' => 'midtrans-permata-va',
                        'name' => 'Permata Virtual Account',
                        'description' => null,
                        'image' => 'files/shares/permata.svg',
                        'is_active' => 0,
                        'order' => 5,
                    ],
                ],
                'e-money' => [
                    0 => [
                        'slug' => 'midtrans-gopay',
                        'name' => 'GoPay',
                        'description' => null,
                        'image' => 'files/shares/gopay.png',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                    1 => [
                        'slug' => 'midtrans-shopeepay',
                        'name' => 'ShopeePay',
                        'description' => null,
                        'image' => 'files/shares/shopeepay.png',
                        'is_active' => 0,
                        'order' => 2,
                    ],
                ],
                'direct-debit' => [
                    0 => [
                        'slug' => 'midtrans-bca-klikpay',
                        'name' => 'BCA KlikPay',
                        'description' => null,
                        'image' => 'files/shares/bca_klikpay.svg',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                    1 => [
                        'slug' => 'midtrans-cimb-clicks',
                        'name' => 'CIMB Clicks',
                        'description' => null,
                        'image' => 'files/shares/cimb_clicks.svg',
                        'is_active' => 0,
                        'order' => 2,
                    ],
                    2 => [
                        'slug' => 'midtrans-danamon-online',
                        'name' => 'Danamon Online Banking',
                        'description' => null,
                        'image' => 'files/shares/danamon.png',
                        'is_active' => 0,
                        'order' => 3,
                    ],
                    3 => [
                        'slug' => 'midtrans-bri-epay',
                        'name' => 'BRI Epay',
                        'description' => null,
                        'image' => 'files/shares/epay_bri.png',
                        'is_active' => 0,
                        'order' => 4,
                    ],
                ],
                'convenience-store' => [
                    0 => [
                        'slug' => 'midtrans-alfamart',
                        'name' => 'Alfamart',
                        'description' => null,
                        'image' => 'files/shares/alfamart.svg',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                    1 => [
                        'slug' => 'midtrans-indomaret',
                        'name' => 'Indomaret',
                        'description' => null,
                        'image' => 'files/shares/indomaret.png',
                        'is_active' => 0,
                        'order' => 2,
                    ],
                ],
                'cardless-credit' => [
                    0 => [
                        'slug' => 'midtrans-akulaku',
                        'name' => 'Akulaku',
                        'description' => null,
                        'image' => 'files/shares/akulaku_logo.svg',
                        'is_active' => 0,
                        'order' => 1,
                    ],
                ],
            ];

            foreach ($payments as $key => $value) {
                $payment = Payment::where('slug', $key)
                    ->first();

                if (isset($payment)) {
                    foreach ($value as $k => $v) {
                        PaymentOption::firstOrCreate([
                            'payment_id' => $payment->id,
                            'slug' => $v['slug'],
                            'name' => $v['name'],
                            'description' => $v['description'],
                            'image' => $v['image'],
                            'is_active' => $v['is_active'],
                            'order' => $v['order'],
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception('Exception occur ' . $e);
            DB::rollBack();
        }

        DB::commit();
    }
}
