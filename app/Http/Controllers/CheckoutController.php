<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
  public function checkout()
  {
    if (!Session::has('cart'))
    {
      return Redirect::back();
    }
    return view('client.checkout');
  }

  public function post_checkout(Request $request)
  {
    if (!Session::has('cart'))
    {
      return redirect::to('/cart');
      // , ['Products' => null]
    }
    $old_cart = Session::get('cart');
    $cart     = new Cart($old_cart);

    Stripe::setApiKey('sk_test_51HwnxzBhwbMEU8sQTg3a9csW5Gl56qm2Ziq5bA23JPwUTXDZZLwqw3J3ucF6tdabhoIQBavqkNEvYFuYiRWwVDo500DbvtaipZ');

    try {
      Charge::create(array(
        "amount"      => $cart->total_price * 100,
        "currency"    => "usd",
        "source"      => $request->input('stripeToken'), // obtainded with Stripe.js
        "description" => "Test Charge",
      ));
    }
    catch (\Exception $e)
    {
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }

    Session::forget('cart');
    // Session::put('success', 'Purchase accomplished successfully !');
    // return redirect::to('/');
    return redirect('cart')->with('success', 'Payment successful.');
  }
}
