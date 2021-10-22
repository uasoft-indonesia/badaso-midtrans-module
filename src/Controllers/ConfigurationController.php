<?php

namespace Uasoft\Badaso\Module\Midtrans\Controllers;

use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\Commerce\Models\Payment;
use Uasoft\Badaso\Module\Commerce\Models\PaymentOption;

class ConfigurationController extends Controller
{
    protected $slugs = [];

    public function __construct()
    {
        $payments_module_list = config('badaso-commerce.payments');
        $slugs = [];

        foreach ($payments_module_list as $module) {
            $module_class = new $module();
            foreach ($module_class->getProtectedPaymentSlug() as $key => $slug) {
                $this->slugs[] = $slug;
            }
        }
    }

    public function browseConfiguration()
    {
        try {
            $payments = Payment::with(['options' => function ($query) {
                return $query->whereIn('slug', $this->slugs);
            }])->get();

            $data['payments'] = collect($payments)->toArray();
            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function savePaymentConfiguration(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Commerce\Models\Payment,id',
                'is_active' => 'required|boolean'
            ]);

            Payment::where('id', $request->id)
                ->whereHas('options', function ($query) {
                    return $query->whereIn('slug', $this->slugs);
                })
                ->update([
                    'is_active' => $request->isActive
                ]);

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function saveOptionConfiguration(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Commerce\Models\PaymentOption,id',
                'is_active' => 'required|boolean'
            ]);

            PaymentOption::where('id', $request->id)
                ->whereIn('slug', $this->slugs)
                ->update([
                    'is_active' => $request->isActive
                ]);

            return ApiResponse::success();
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}
