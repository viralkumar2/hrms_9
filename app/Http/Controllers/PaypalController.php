<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Product;
use App\Models\ProductVariantOption;
use App\Models\Retainer;
use App\Models\RetainerPayment;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\PurchasedProducts;
class PaypalController extends Controller
{
    private $_api_context;


    public function customerPayWithPaypal(Request $request, $invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        if (Auth::check()) {
            $settings = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
            $user = \Auth::user();
        } else {
            $user = User::where('id', $invoice->created_by)->first();
            $settings = Utility::settingById($invoice->created_by);
        }

        $get_amount = $request->amount;

        $request->validate(['amount' => 'required|numeric|min:0']);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));

        if ($invoice) {
            if ($get_amount > $invoice->getDue()) {
                return redirect()->back()->with('error', __('Invalid amount.'));
            } else {

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $name = Utility::invoiceNumberFormat($settings, $invoice->invoice_id);

                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('customer.get.payment.status', [$invoice->id, $get_amount]),
                        "cancel_url" => route('customer.get.payment.status', [$invoice->id, $get_amount]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => Utility::getValByName('site_currency'),
                                "value" => $get_amount,
                            ],
                        ],
                    ],
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('invoice.show', \Crypt::encrypt($invoice->id))
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        ->route('invoice.show', \Crypt::encrypt($invoice->id))
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }


                return redirect()->route('customer.invoice.show', \Crypt::encrypt($invoice_id))->back()->with('error', __('Unknown error occurred'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function paymentConfig()
    {
        if (\Auth::check()) {
            $payment_setting = Utility::getAdminPaymentSetting();
        } else {
            $payment_setting = Utility::getCompanyPaymentSetting($this->invoiceData->created_by);
        }
        
        if($payment_setting['paypal_mode'] == 'live'){
              config([
                        'paypal.live.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                        'paypal.live.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                        'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
                    ]);
        }else{
             config([
                        'paypal.sandbox.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                        'paypal.sandbox.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                        'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
                    ]);
        }
    
    }

    public function planPayWithPaypal(Request $request)
    {
        $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan   = Plan::find($planID);
        $this->paymentConfig();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $get_amount = $plan->price;
       
        // dd($get_amount);
        if($plan){
            try
            {
                $coupons_id = 0;
                $price     = $plan->price;
                if(!empty($request->coupon))
                {
                   
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if(!empty($coupons))
                    {
                        $usedCoupun     = $coupons->used_coupon();
                        $discount_value = ($plan->price / 100) * $coupons->discount;
                        $price          = $plan->price - $discount_value;
                        if($coupons->limit == $usedCoupun)
                        {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                        $coupon_id = $coupons->id;
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }
                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('plan.get.payment.status',[$plan->id,$get_amount]),
                        "cancel_url" =>  route('plan.get.payment.status',[$plan->id,$get_amount]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => Utility::getValByName('site_currency'),
                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);
               
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('plans.index')
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        ->route('plans.index')
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        }else{
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }


    public function planGetPaymentStatus(Request $request, $plan_id)
    {
       
        $this->paymentconfig();
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        

        if ($plan) {
            // $this->paymentConfig();
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            // dd($response);
            $payment_id = Session::get('paypal_payment_id');
            $order_id = strtoupper(str_replace('.', '', uniqid('', true)));

            // $status  = ucwords(str_replace('_', ' ', $result['state']));
            if ($request->has('coupon_id') && $request->coupon_id != '') {
                $coupons = Coupon::find($request->coupon_id);
                if (!empty($coupons)) {
                    $userCoupon = new UserCoupon();
                    $userCoupon->user = $user->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order = $order_id;
                    $userCoupon->save();
                    $usedCoupun = $coupons->used_coupon();
                    if ($coupons->limit <= $usedCoupun) {
                        $coupons->is_active = 0;
                        $coupons->save();
                    }
                }
            }
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                if ($response['status'] == 'COMPLETED') {
                    $statuses = 'success';
                }
                // dd($response);
                $order = new Order();
                $order->order_id = $order_id;
                $order->name = $user->name;
                $order->card_number = '';
                $order->card_exp_month = '';
                $order->card_exp_year = '';
                $order->plan_name = $plan->name;
                $order->plan_id = $plan->id;
                $order->price = $plan->price;
                $order->price_currency = env('CURRENCY');
                $order->txn_id = $payment_id;
                $order->payment_type = __('PAYPAL');
                $order->payment_status = $statuses;
                $order->txn_id = '';
                $order->receipt = '';
                $order->user_id = $user->id;
                $order->save();
                $assignPlan = $user->assignPlan($plan->id);
                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }

                return redirect()
                    ->route('plans.index')
                    ->with('success', 'Transaction complete.');
            } else {
                return redirect()
                    ->route('plans.index')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function customerretainerPayWithPaypal(Request $request, $retainer_id)
    {

        $retainer = Retainer::find($retainer_id);
        if (Auth::check()) {
            $settings = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
            $user = \Auth::user();
        } else {
            $user = User::where('id', $retainer->created_by)->first();
            $settings = Utility::settingById($retainer->created_by);
        }

        $get_amount = $request->amount;

        $request->validate(['amount' => 'required|numeric|min:0']);

        if ($retainer) {
            if ($get_amount > $retainer->getDue()) {
                return redirect()->back()->with('error', __('Invalid amount.'));
            } else {
                if (Auth::check()) {
                    $this->setApiContext();
                } else {
                    $this->non_auth_setApiContext($retainer->created_by);
                }

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

                $name = Utility::retainerNumberFormat($settings, $retainer->retainer_id);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name)->setCurrency(Utility::getValByName('site_currency'))->setQuantity(1)->setPrice($get_amount);

                $item_list = new ItemList();
                $item_list->setItems([$item_1]);

                $amount = new Amount();
                $amount->setCurrency(Utility::getValByName('site_currency'))->setTotal($get_amount);

                $transaction = new Transaction();
                $transaction->setAmount($amount)->setItemList($item_list)->setDescription($name)->setInvoiceNumber($orderID);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(
                    route(
                        'customer.get.retainer.payment.status',
                        $retainer->id
                    )
                )->setCancelUrl(
                    route(
                        'customer.get.retainer.payment.status',
                        $retainer->id
                    )
                );

                $payment = new Payment();
                $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions([$transaction]);

                try {

                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PayPalConnectionException$ex) {
                    if (\Config::get('app.debug')) {
                        return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer_id))->back()->with('error', __('Connection timeout'));
                    } else {
                        return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer_id))->back()->with('error', __('Some error occur, sorry for inconvenient'));
                    }

            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }

            return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer_id))->back()->with('error', __('Unknown error occurred'));
        }
    } else {
        return redirect()->back()->with('error', __('Permission denied.'));
    }
}

function customerGetRetainerPaymentStatus(Request $request, $retainer_id)
{
    // dd($request->all());
    $retainer = Retainer::find($retainer_id);
    if (Auth::check()) {
        $settings = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
        $user = \Auth::user();
        $this->setApiContext();
    } else {
        $user = User::where('id', $retainer->created_by)->first();
        $settings = Utility::settingById($retainer->created_by);
        $this->non_auth_setApiContext($retainer->created_by);
    }

    $payment_id = Session::get('paypal_payment_id');

    Session::forget('paypal_payment_id');

    if (empty($request->PayerID || empty($request->token))) {
        return redirect()->back()->with('error', __('Payment failed'));
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    $execution = new PaymentExecution();
    $execution->setPayerId($request->PayerID);

    try {
        $result = $payment->execute($execution, $this->_api_context)->toArray();
        $order_id = strtoupper(str_replace('.', '', uniqid('', true)));
        $status = ucwords(str_replace('_', ' ', $result['state']));
        if ($result['state'] == 'approved') {
            $amount = $result['transactions'][0]['amount']['total'];
        } else {
            $amount = isset($result['transactions'][0]['amount']['total']) ? $result['transactions'][0]['amount']['total'] : '0.00';
        }

        if ($result['state'] == 'approved') {
            $payments = RetainerPayment::create(
                [

                    'retainer_id' => $retainer->id,
                    'date' => date('Y-m-d'),
                    'amount' => $amount,
                    'account_id' => 0,
                    'payment_method' => 0,
                    'order_id' => $order_id,
                    'currency' => Utility::getValByName('site_currency'),
                    'txn_id' => $payment_id,
                    'payment_type' => __('PAYPAL'),
                    'receipt' => '',
                    'reference' => '',
                    'description' => 'Retainer ' . Utility::retainerNumberFormat($settings, $retainer->retainer_id),
                ]
            );

            if ($retainer->getDue() <= 0) {
                $retainer->status = 4;
                $retainer->save();
            } elseif (($retainer->getDue() - $payments->amount) == 0) {
                $retainer->status = 4;
                $retainer->save();
            } else {
                $retainer->status = 3;
                $retainer->save();
            }

            $retainerPayment = new Transaction();
            $retainerPayment->user_id = $retainer->customer_id;
            $retainerPayment->user_type = 'Customer';
            $retainerPayment->type = 'PAYPAL';
            $retainerPayment->created_by = \Auth::check() ? \Auth::user()->id : $retainer->customer_id;
            $retainerPayment->payment_id = $retainerPayment->id;
            $retainerPayment->category = 'Retainer';
            $retainerPayment->amount = $amount;
            $retainerPayment->date = date('Y-m-d');
            $retainerPayment->created_by = \Auth::check() ? \Auth::user()->creatorId() : $retainer->created_by;
            $retainerPayment->payment_id = $payments->id;
            $retainerPayment->description = 'Retainer ' . Utility::retainerNumberFormat($settings, $retainer->retainer_id);
            $retainerPayment->account = 0;

            \App\Models\Transaction::addTransaction($retainerPayment);

            Utility::userBalance('customer', $retainer->customer_id, $request->amount, 'debit');

            Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

            //Twilio Notification
            if (Auth::check()) {
                $setting = Utility::settings(\Auth::user()->creatorId());
            }
            $customer = Customer::find($retainer->customer_id);
            if (isset($setting['payment_notification']) && $setting['payment_notification'] == 1) {
                $msg = __("New payment of") . ' ' . $amount . __("created for") . ' ' . $customer->name . __("by") . ' ' . $retainerPayment->type . '.';
                Utility::send_twilio_msg($customer->contact, $msg);
            }

            if (Auth::check()) {
                return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer->id))->with('success', __('Payment successfully added.'));
            } else {
                return redirect()->back()->with('success', __(' Payment successfully added.'));
            }
        } else {
            if (Auth::check()) {
                return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer->id))->with('error', __('Transaction has been ' . $status));
            } else {
                return redirect()->back()->with('success', __('Transaction succesfull'));
            }
        }
    } catch (\Exception$e) {
        if (Auth::check()) {
            return redirect()->route('customer.retainer.show', \Crypt::encrypt($retainer->id))->with('error', __('Transaction has been failed.'));
        } else {
            return redirect()->back()->with('success', __('Transaction has been complted.'));
        }
    }
}

function customerGetPaymentStatus(Request $request, $invoice_id, $amount)
{
    $invoice = Invoice::find($invoice_id);

    if (Auth::check()) {
        $settings = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
        $user = \Auth::user();
    } else {
        $user = User::where('id', $invoice->created_by)->first();
        $settings = Utility::settingById($invoice->created_by);
    }

    $payment_id = Session::get('PayerID');
    $provider = new PayPalClient;
    $response = $provider->showAuthorizedPaymentDetails($request->PayerID);

    Session::forget('PayerID');

    if (empty($request->PayerID || empty($request->token))) {
        return redirect()->back()->with('error', __('Payment failed'));
    }
    try {
        $order_id = strtoupper(str_replace('.', '', uniqid('', true)));
        $payments = InvoicePayment::create(
            [

                'invoice_id' => $invoice->id,
                'date' => date('Y-m-d'),
                'amount' => $amount,
                'account_id' => 0,
                'payment_method' => 0,
                'order_id' => $order_id,
                'currency' => Utility::getValByName('site_currency'),
                'txn_id' => $payment_id,
                'payment_type' => __('PAYPAL'),
                'receipt' => '',
                'reference' => '',
                'description' => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
            ]
        );

        if ($invoice->getDue() <= 0) {
            $invoice->status = 4;
            $invoice->save();
        } elseif (($invoice->getDue() - $payments->amount) == 0) {
            $invoice->status = 4;
            $invoice->save();
        } elseif ($invoice->getDue() > 0) {
            $invoice->status = 3;
            $invoice->save();
        } else {
            $invoice->status = 2;
            $invoice->save();
        }

        $invoicePayment = new \App\Models\Transaction();
        $invoicePayment->user_id = $invoice->customer_id;
        $invoicePayment->user_type = 'Customer';
        $invoicePayment->type = 'PAYPAL';
        $invoicePayment->created_by = \Auth::check() ? \Auth::user()->id : $invoice->customer_id;
        $invoicePayment->payment_id = $invoicePayment->id;
        $invoicePayment->category = 'Invoice';
        $invoicePayment->amount = $amount;
        $invoicePayment->date = date('Y-m-d');
        $invoicePayment->created_by = \Auth::check() ? \Auth::user()->creatorId() : $invoice->created_by;
        $invoicePayment->payment_id = $payments->id;
        $invoicePayment->description = 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id);
        $invoicePayment->account = 0;

        \App\Models\Transaction::addTransaction($invoicePayment);
        if (Auth::check()) {
            return redirect()->route('invoice.show', \Crypt::encrypt($invoice->id))->with('success', __('Payment successfully added.'));
        } else {
            return redirect()->back()->with('success', __(' Payment successfully added.'));
        }
    } catch (\Exception$e) {
        if (Auth::check()) {
            return redirect()->route('invoice.show', \Crypt::encrypt($invoice->id))->with('error', __('Transaction has been failed.'));
        } else {
            return redirect()->back()->with('success', __('Transaction has been complted.'));
        }
    }
}

// product payments
function PayWithPaypal(Request $request, $slug)
{
    $cart = session()->get($slug);
    $products = $cart['products'];

    $store = Store::where('slug', $slug)->first();

    $admin_payments_details = Utility::getPaymentSetting($store->id);

    config(
        [
            'paypal.sandbox.client_id' => isset($admin_payments_details['paypal_client_id']) ? $admin_payments_details['paypal_client_id'] : '',
            'paypal.sandbox.client_secret' => isset($admin_payments_details['paypal_secret_key']) ? $admin_payments_details['paypal_secret_key'] : '',
            'paypal.mode' => isset($admin_payments_details['paypal_mode']) ? $admin_payments_details['paypal_mode'] : '',
        ]
    );

    $provider = new PayPalClient;

    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();

    Session::put('paypal_payment_id', $paypalToken['access_token']);
    $objUser = \Auth::user();

    $total_tax = $sub_total = $total = $sub_tax = 0;
    $product_name = [];
    $product_id = [];

    foreach ($products as $key => $product) {
        if ($product['variant_id'] != 0) {

            $product_name[] = $product['product_name'];
            $product_id[] = $key;

            foreach ($product['tax'] as $tax) {
                $sub_tax = ($product['variant_price'] * $product['quantity'] * $tax['tax']) / 100;
                $total_tax += $sub_tax;
            }
            $totalprice = $product['variant_price'] * $product['quantity'];
            $total += $totalprice;
        } else {
            $product_name[] = $product['product_name'];
            $product_id[] = $key;

            foreach ($product['tax'] as $tax) {
                $sub_tax = ($product['price'] * $product['quantity'] * $tax['tax']) / 100;
                $total_tax += $sub_tax;
            }
            $totalprice = $product['price'] * $product['quantity'];
            $total += $totalprice;
        }
    }


    // $this->paymentconfig();
    if ($products) {
        try
        {
            $coupon_id = null;
            $price = $total + $total_tax;
            if (isset($cart['coupon'])) {
                if ($cart['coupon']['coupon']['enable_flat'] == 'off') {
                    $discount_value = ($price / 100) * $cart['coupon']['coupon']['discount'];
                    $price = $price - $discount_value;
                } else {
                    $discount_value = $cart['coupon']['coupon']['flat_discount'];
                    $price = $price - $discount_value;
                }
            }

            if (isset($cart['shipping']) && isset($cart['shipping']['shipping_id']) && !empty($cart['shipping'])) {
                $shipping = Shipping::find($cart['shipping']['shipping_id']);
                if (!empty($shipping)) {
                    $price = $price + $shipping->price;
                }
            }


            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('get.payment.status', $store->slug),
                    "cancel_url" => route('get.payment.status', $store->slug),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => Utility::getValByName('site_currency'),
                            "value" => $price,
                        ],
                    ],
                ],
            ]);
            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('plans.index')
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('plans.index')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }

        } catch (\Exception$e) {
            return redirect()->back()->with('error', __('Unknown error occurred'));
        }
    } else {
        return redirect()->back()->with('error', __('is deleted.'));
    }
}

function GetPaymentStatus(Request $request, $slug)
{
    $store = Store::where('slug', $slug)->first();
    $admin_payments_details = Utility::getPaymentSetting($store->id);

    config(
        [
            'paypal.sandbox.client_id' => isset($admin_payments_details['paypal_client_id']) ? $admin_payments_details['paypal_client_id'] : '',
            'paypal.sandbox.client_secret' => isset($admin_payments_details['paypal_secret_key']) ? $admin_payments_details['paypal_secret_key'] : '',
            'paypal.mode' => isset($admin_payments_details['paypal_mode']) ? $admin_payments_details['paypal_mode'] : '',
        ]
    );
    $cart = session()->get($slug);
    if (isset($cart['coupon'])) {
        $coupon = $cart['coupon']['coupon'];
    }
    if (isset($cart) && !empty($cart['products'])) {
        $products = $cart['products'];
    } else {
        return redirect()->back()->with('error', __('Please add to product into cart'));
    }
    $user_details = $cart['customer'];

    $total = 0;
    $new_qty = 0;
    $sub_total = 0;
    $total_tax = 0;
    $product_name = [];
    $product_id = [];
    $quantity = [];
    $pro_tax = [];
    $sub_tax = 0;
    foreach ($products as $key => $product) {
        if ($product['variant_id'] != 0) {
            $new_qty = $product['originalvariantquantity'] - $product['quantity'];
            $product_edit = ProductVariantOption::find($product['variant_id']);
            $product_edit->quantity = $new_qty;
            $product_edit->save();

            $product_name[] = $product['product_name'];
            $product_id[] = $key;
            $quantity[] = $product['quantity'];

            foreach ($product['tax'] as $tax) {
                $sub_tax = ($product['variant_price'] * $product['quantity'] * $tax['tax']) / 100;
                $total_tax += $sub_tax;
                $pro_tax[] = $sub_tax;
            }
            $totalprice = $product['variant_price'] * $product['quantity'];
            $subtotal = $product['variant_price'] * $product['quantity'];
            $sub_total += $subtotal;
            $total += $totalprice;
        } else {
            $new_qty = $product['originalquantity'] - $product['quantity'];
            $product_edit = Product::find($product['product_id']);
            $product_edit->quantity = $new_qty;
            $product_edit->save();

            $product_name[] = $product['product_name'];
            $product_id[] = $key;
            $quantity[] = $product['quantity'];

            foreach ($product['tax'] as $tax) {
                $sub_tax = ($product['price'] * $product['quantity'] * $tax['tax']) / 100;
                $total_tax += $sub_tax;
                $pro_tax[] = $sub_tax;
            }
            $totalprice = $product['price'] * $product['quantity'];
            $subtotal = $product['price'] * $product['quantity'];
            $sub_total += $subtotal;
            $total += $totalprice;
        }
    }
    $price = $totalprice + $sub_tax;
    if (isset($cart['coupon'])) {
        if ($cart['coupon']['coupon']['enable_flat'] == 'off') {
            $discount_value = ($price / 100) * $cart['coupon']['coupon']['discount'];
            $price = $price - $discount_value;
        } else {
            $discount_value = $cart['coupon']['coupon']['flat_discount'];
            $price = $price - $discount_value;
        }
    }
    if (isset($cart['shipping']) && isset($cart['shipping']['shipping_id']) && !empty($cart['shipping'])) {
        $shipping = Shipping::find($cart['shipping']['shipping_id']);
        if (!empty($shipping)) {
            $shipping_name = $shipping->name;
            $shipping_price = $shipping->price;

            $shipping_data = json_encode(
                [
                    'shipping_name' => $shipping_name,
                    'shipping_price' => $shipping_price,
                    'location_id' => $cart['shipping']['location_id'],
                ]
            );
        } else {
            $shipping_data = '';
        }
    }
    $user = Auth::user();

    if ($product) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        $payment_id = Session::get('paypal_payment_id');

        $order_id = strtoupper(str_replace('.', '', uniqid('', true)));

        // $this->setApiContext($slug);
        // $payment_id = Session::get('paypal_payment_id');
        // Session::forget('paypal_payment_id');
        // if(empty($request->PayerID || empty($request->token)))
        // {
        //     return redirect()->route('store-payment.payment', $slug)->with('error', __('Payment failed'));
        // }
        // $payment   = Payment::get($payment_id, $this->_api_context);
        // $execution = new PaymentExecution();
        // $execution->setPayerId($request->PayerID);
        try
        {
            $order = new Order();
            $order->user_id = Auth()->id();
            $latestOrder = Order::orderBy('created_at', 'DESC')->first();
            if (!empty($latestOrder)) {
                $order->order_nr = '#' . str_pad($latestOrder->id + 1, 4, "100", STR_PAD_LEFT);
            } else {
                $order->order_nr = '#' . str_pad(1, 4, "100", STR_PAD_LEFT);

            }
            $orderID = $order->order_nr;
            $statuses ='';
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {

                if ($response['status'] == 'COMPLETED') {

                    $statuses = 'success';
                }

                // dd($response,$provider, $total);
                // $status = ucwords(str_replace('_', ' ', $result['state']));

                    if (Utility::CustomerAuthCheck($store->slug)) {
                        $customer = Auth::guard('customers')->user()->id;
                    } else {
                        $customer = 0;
                    }

                    $customer = Auth::guard('customers')->user();
                    $order = new Order();
                    $order->order_id = $orderID;
                    $order->name = $user_details['name'];
                    $order->email = $user_details['email'];
                    $order->card_number = '';
                    $order->card_exp_month = '';
                    $order->card_exp_year = '';
                    $order->status = 'pending';
                    $order->user_address_id = $user_details['id'];
                    $order->shipping_data = !empty($shipping_data) ? $shipping_data : '';
                    $order->coupon = $price;
                    $order->coupon_json = json_encode(!empty($coupon) ? $coupon : '');
                    $order->discount_price = !empty($cart['coupon']['discount_price']) ? $cart['coupon']['discount_price'] : '';
                    $order->price = $total;
                    $order->product = json_encode($products);
                    $order->price_currency = $store->currency_code;
                    $order->txn_id = $payment_id;
                    $order->payment_type = __('PAYPAL');
                    $order->payment_status = $statuses;
                    $order->receipt = '';
                    $order->user_id = $store['id'];
                    $order->customer_id = isset($customer->id) ? $customer->id : '';


                    $order->save();


                    if ((!empty(Auth::guard('customers')->user()) && $store->is_checkout_login_required == 'on')) {
                        foreach ($products as $product_id) {
                            $purchased_products = new PurchasedProducts();
                            $purchased_products->product_id = $product_id['product_id'];
                            $purchased_products->customer_id = $customer->id;
                            $purchased_products->order_id = $order->id;
                            $purchased_products->save();
                        }
                    }
                    session()->forget($slug);

                    $order_email = $order->email;

                    $owner = User::find($store->created_by);

                    $owner_email = $owner->email;

                    $order_id = Crypt::encrypt($order->id);
                    if (isset($store->mail_driver) && !empty($store->mail_driver)) {
                        $dArr = [
                            'order_name' => $order->name,
                        ];
                        $resp = Utility::sendEmailTemplate('Order Created', $order_email, $dArr, $store, $order_id);

                        $resp1 = Utility::sendEmailTemplate('Order Created For Owner', $owner_email, $dArr, $store, $order_id);

                    }
                    if (isset($store->is_twilio_enabled) && $store->is_twilio_enabled == "on") {
                        Utility::order_create_owner($order, $owner, $store);
                        Utility::order_create_customer($order, $customer, $store);
                    }

                    return redirect()->route(
                        'store-complete.complete', [
                            $store->slug,
                            Crypt::encrypt($order->id),
                        ]
                    )->with('success', __('Transaction has been') . $statuses);

            }else {
                return redirect()->back()->with('error', __('Transaction has been') . $statuses);
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('error', __('Transaction has been failed.'));
        }
    } else {
        return redirect()->back()->with('error', __(' is deleted.'));
    }
}

}
