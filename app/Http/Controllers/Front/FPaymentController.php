<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Ilsyaa;
use App\Helpers\Metavis;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Payment;
use App\Models\ProductLibrary;
use App\Models\WebMaster;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalWibu;
use App\Models\License;

class FPaymentController extends Controller
{

    public $config_paypal, $webmaster;

    public function __construct()
    {
        $this->webmaster = WebMaster::first();
        $this->config_paypal = [
            'mode'    => "" . $this->webmaster->paypal_mode . "", // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => '' . $this->webmaster->paypal_sandbox_client_id . '',
                'client_secret'     => '' . $this->webmaster->paypal_sandbox_client_secret . '',
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => '' . $this->webmaster->paypal_live_client_id . '',
                'client_secret'     => '' . $this->webmaster->paypal_live_client_secret . '',
                'app_id'            => '',
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => 'USD',
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true,
        ];
        config(['paypal' => $this->config_paypal]);
    }

    public function method(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if (!$product) {
            return '<div class="text-center">Product not found</div>';
        }
        if (auth()->check()) {
            if ($product->isPurchased($product->id, auth()->user()->id)) {
                return '<div class="text-center">You have already purchased this product</div>';
            }
        }
        return view('frontend.payment.method', [
            'product' => $product,
            'webmaster' => $this->webmaster
        ]);
    }

    public function paypal_process(Request $request)
    {
        if ($this->webmaster->paypal_status == 'inactive') {
            return redirect()->route('front.checkout', $request->product_id)->with('error', 'Paypal is not active');
        }
        $product = Product::where('id', $request->product_id)
            ->where('status', '!=', 'draft')
            ->where('product_type', '!=', 'free');
        if ($product->count() == 0) {
            return redirect()->route('front.product.category')->with('error', 'Product not found');
        }
        $product = $product->first();
        try {
            $provider = new PayPalWibu;
            $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('front.payment.paypal.success'),
                    "cancel_url" => route('front.payment.paypal.cancel'),
                ],
                "purchase_units" => [
                    0 => [
                        "reference_id" => $product->id,
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => '' . $product->after_discount("usd") . '',
                        ]
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return Metavis::abort('Please Refresh Page', $e->getMessage());
        }
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return Metavis::abort('Something went wrong.', 'Something went wrong.', [
                'title' => 'back Checkout',
                'url' => route('front.checkout', $product->slug)
            ]);
        } else {
            return Metavis::abort('Oops.', 'Refresh the page and try again');
        }
    }

    public function paypal_success(Request $request)
    {
        try {
            $provider = new PayPalWibu;
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
        } catch (\Exception $e) {
            return Metavis::abort('Refresh Page', 'Refresing the page may solve the problem.', [
                'title' => 'Refresh Page',
                'url' => url()->full()
            ]);
        }
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $license_unique = Ilsyaa::license_unique();
            $slug_unique = Ilsyaa::slug_unique();

            $payment = new Payment;
            $payment->user_id = auth()->user()->id;
            $payment->product_id = $response['purchase_units'][0]['reference_id'];
            $payment->payment_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];
            $payment->payment_type = 'product';
            $payment->payment_method = 'paypal';
            $payment->payment_status = $response['status'];
            $payment->payment_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->payment_currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payment_country = $response['purchase_units'][0]['shipping']['address']['country_code'];
            $payment->save();
            // insert library
            $library = new ProductLibrary;
            $library->user_id = auth()->user()->id;
            $library->payment_id = $payment->id;
            $library->product_id = $payment->product_id;
            $library->license = $license_unique;
            $library->save();
            // insert license
            $license = new License;
            $license->item_id = $payment->product_id;
            $license->license = $license_unique;
            $license->slug = $slug_unique;
            $license->type = 'product';
            $license->used = 'yes';
            $license->save();

            return redirect()->route('front.library.index')->with('success', 'Payment success.');
        } else {
            return Metavis::abort('Something went wrong.', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paypal_cancel()
    {
        return redirect()->route('front.library.index')->with('error', 'Payment canceled.');
    }
}
