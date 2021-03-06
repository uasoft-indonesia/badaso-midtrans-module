<?php

namespace Uasoft\Badaso\Module\Midtrans\Controllers;

use Midtrans\Config;
use Midtrans\Notification;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Models\User;
use Uasoft\Badaso\Module\Commerce\Events\OrderStateWasChanged;
use Uasoft\Badaso\Module\Commerce\Models\Order;

class MidtransController extends Controller
{
    public function __invoke()
    {
        Config::$isProduction = env('APP_ENV') === 'production';
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');

        try {
            $notification = new Notification();

            $notification = $notification->getResponse();
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $order_id = $notification->order_id;
            $fraud = $notification->fraud_status;

            $order = Order::where('id', $order_id)->firstOrFail();

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->status = 'waitingSellerConfirmation';
                        $order->expired_at = null;
                        $order->save();

                        event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'waitingSellerConfirmation'));
                    } else {
                        $order->status = 'process';
                        $order->expired_at = null;
                        $order->save();

                        event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'process'));
                    }
                }
            } else if ($transaction == 'settlement') {
                $order->status = 'process';
                $order->expired_at = null;
                $order->save();

                event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'process'));
            } else if ($transaction == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
            } else if ($transaction == 'deny') {
                $order->status = 'cancel';
                $order->expired_at = null;
                $order->cancel_message = 'Denied by Midtrans';
                $order->save();

                event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'cancel'));
            } else if ($transaction == 'expire') {
                $order->status = 'cancel';
                $order->expired_at = null;
                $order->cancel_message = 'Expired by Midtrans';
                $order->save();

                event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'cancel'));
            } else if ($transaction == 'cancel') {
                $order->status = 'cancel';
                $order->expired_at = null;
                $order->cancel_message = 'Denied by Midtrans';
                $order->save();

                event(new OrderStateWasChanged(User::where('id', $order->user_id)->first(), $order, 'cancel'));
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}
