<?php

namespace Uasoft\Badaso\Module\Midtrans\Controllers;

use Exception;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\Config as HelperConfig;
use Uasoft\Badaso\Module\Commerce\Models\Order;
use Uasoft\Badaso\Module\Midtrans\Helpers\Configurations;
use Uasoft\Badaso\Module\Midtrans\Services\Midtrans;

class SnapController extends Controller
{
    public function getConfig()
    {
        $midtrans = new Midtrans();
        $clientKey = $midtrans->clientKey;

        return ApiResponse::success(['client_key' => $clientKey, 'base_url' => $this->getSnapBaseUrl()]);
    }

    private function getSnapBaseUrl()
    {
        $midtrans = new Midtrans();

        return $midtrans->isProduction ?
        'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    public function getSnapToken(Request $request)
    {
        try {
            $request->validate([
                'id'           => 'required|exists:Uasoft\Badaso\Module\Commerce\Models\Order,id',
                'payment_type' => 'nullable|string|in:credit_card,gopay,cimb_clicks,bca_klikbca,bca_klikpay,bri_epay,telkomsel_cash,echannel,permata_va,other_va,bca_va,bni_va,bri_va,indomaret,alfamart,danamon_online,akulaku,shopeepay',
            ]);

            $config = Configurations::index();
            $midtrans = new Midtrans();

            Config::$serverKey = $midtrans->serverKey;
            Config::$isProduction = $midtrans->isProduction;
            Config::$isSanitized = $midtrans->isSanitized;
            Config::$is3ds = $midtrans->is3ds;

            if (!Config::$serverKey) {
                throw new Exception('Invalid server key. Please check your .env if server key is set.');
            }

            $order = Order::with(['orderAddress', 'orderPayment', 'orderDetails.productDetail.product'])
                ->where('id', $request->id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $item_details = [];

            foreach ($order->orderDetails as $key => $orderDetail) {
                $item_details[] = [
                    'id'       => $orderDetail->productDetail->id,
                    'price'    => $orderDetail->price,
                    'quantity' => $orderDetail->quantity,
                    'name'     => "{$orderDetail->productDetail->product->name} - {$orderDetail->productDetail->name}",
                ];
            }

            if (HelperConfig::get('commerceUseFixRateShippingCost') == 1) {
                $item_details[] = [
                    'id'       => 'SHIPPING_COST',
                    'price'    => HelperConfig::get('commerceFixRateShippingCost'),
                    'quantity' => 1,
                    'name'     => 'Shipping cost',
                ];
            }

            $midtrans_payments = $config->paymentType;

            if ($midtrans_payments == 1) {
                $params = [
                    'transaction_details' => [
                        'order_id'     => $order->id,
                        'gross_amount' => $order->payed,
                    ],
                    'customer_details' => [
                        'first_name' => $order->orderAddress->recipient_name,
                        'email'      => auth()->user()->email,
                        'phone'      => $order->orderAddress->phone_number,
                    ],
                    'item_details'     => $item_details,
                    'enabled_payments' => [$request->payment_type],
                ];
            } else {
                $params = [
                    'transaction_details' => [
                        'order_id'     => $order->id,
                        'gross_amount' => $order->payed,
                    ],
                    'customer_details' => [
                        'first_name' => $order->orderAddress->recipient_name,
                        'email'      => auth()->user()->email,
                        'phone'      => $order->orderAddress->phone_number,
                    ],
                    'item_details' => $item_details,

                ];
            }

            $snapToken = Snap::getSnapToken($params);

            $order->orderPayment->token = $snapToken;
            $order->orderPayment->save();

            return ApiResponse::success(['token' => $snapToken]);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}
