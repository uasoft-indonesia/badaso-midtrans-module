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

class SnapController extends Controller
{
    public function getConfig()
    {
        if (!empty(env('MIDTRANS_CLIENT_KEY'))) {
            $midtransClientKey = env('MIDTRANS_CLIENT_KEY');
        } else {
            $config = Configurations::index();
            $midtransClientKey = $config->clientKey;
        }
        return ApiResponse::success(['client_key' => $midtransClientKey, 'base_url' => $this->getSnapBaseUrl()]);
    }

    private function getSnapBaseUrl()
    {
        return Config::$isProduction ?
        'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    public function getSnapToken(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Commerce\Models\Order,id',
                'payment_type' => 'nullable|string|in:credit_card,gopay,cimb_clicks,bca_klikbca,bca_klikpay,bri_epay,telkomsel_cash,echannel,permata_va,other_va,bca_va,bni_va,bri_va,indomaret,alfamart,danamon_online,akulaku,shopeepay'
            ]);

            $config = Configurations::index();

            if (!empty(env('MIDTRANS_SERVER_KEY'))) {
                $midtransServerKey = env('MIDTRANS_SERVER_KEY');
            } else {
                $midtransServerKey = $config->serverKey;
            }
            Config::$serverKey = $midtransServerKey;
            // Config::$isProduction = env('APP_ENV') === 'production';
            Config::$isProduction = true;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            if (!Config::$serverKey) {
                throw new Exception("Invalid server key. Please check your .env if server key is set.");
            }

            $order = Order::with(['orderAddress','orderPayment', 'orderDetails.productDetail.product'])
                ->where('id', $request->id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            $item_details = [];

            foreach ($order->orderDetails as $key => $orderDetail) {
                $item_details[] = array(
                    'id' => $orderDetail->productDetail->id,
                    'price' => $orderDetail->price,
                    'quantity' => $orderDetail->quantity,
                    'name' => "{$orderDetail->productDetail->product->name} - {$orderDetail->productDetail->name}",
                );
            }

            if (HelperConfig::get('commerceUseFixRateShippingCost') == 1) {
                $item_details[] = array(
                    'id' => 'SHIPPING_COST',
                    'price' => HelperConfig::get('commerceFixRateShippingCost'),
                    'quantity' => 1,
                    'name' => "Shipping cost",
                );
            }

            $midtrans_payments = $config->paymentType;

            if($midtrans_payments == 1)
            {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $order->id,
                        'gross_amount' => $order->payed,
                    ),
                    'customer_details' => array(
                        'first_name' => $order->orderAddress->recipient_name,
                        'email' => auth()->user()->email,
                        'phone' => $order->orderAddress->phone_number,
                    ),
                    'item_details' => $item_details,
                    'enabled_payments' => [$request->payment_type],
                );
            }
            else
            {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $order->id,
                        'gross_amount' => $order->payed,
                    ),
                    'customer_details' => array(
                        'first_name' => $order->orderAddress->recipient_name,
                        'email' => auth()->user()->email,
                        'phone' => $order->orderAddress->phone_number,
                    ),
                    'item_details' => $item_details,

                );
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
