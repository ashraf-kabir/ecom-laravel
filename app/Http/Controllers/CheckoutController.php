<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
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

    $request->validate([
      'first_name' => 'required|max:100',
      'last_name'  => 'required|max:155',
      'email'      => 'required|email|max:255',
      'phone'      => 'required|max:20',
      'city'       => 'required|max:25',
      'state'      => 'required|max:2',
      'zip'        => 'required|numeric',
      'country'    => 'required|max:2',
      'card_name'  => 'required|max:255',
      'card_no'    => 'required|numeric|digits:16',
      'card_month' => 'required|numeric|digits:2',
      'card_year'  => 'required|numeric|digits:2',
      'cvc'        => 'required|numeric|digits:3',
    ]);

    Stripe::setApiKey('sk_test_51HwnxzBhwbMEU8sQTg3a9csW5Gl56qm2Ziq5bA23JPwUTXDZZLwqw3J3ucF6tdabhoIQBavqkNEvYFuYiRWwVDo500DbvtaipZ');

    try {
      $charge = Charge::create(array(
        "amount"      => $cart->total_price * 100,
        "currency"    => "usd",
        "source"      => $request->input('stripeToken'), // obtained with Stripe.js
        "description" => "Test Charge",
      ));

      $order = new Order();

      $order->name       = $request->input('first_name') . ' ' . $request->input('last_name');
      $order->email      = $request->input('email');
      $order->phone      = $request->input('phone');
      $order->address    = $request->input('address_1') . ' ' . $request->input('address_2');
      $order->city       = $request->input('city');
      $order->state      = $request->input('state');
      $order->zip        = $request->input('zip');
      $order->country    = $request->input('country');
      $order->cart       = serialize($cart);
      $order->payment_id = $charge->id;

      $order->save();

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
