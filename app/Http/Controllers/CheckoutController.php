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
    if (!Session::has('client'))
    {
      return redirect('/login')->with('msg', 'You must login to continue.');
    }

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
      'first_name' => 'required|string|between:2,100',
      'last_name'  => 'required|string|between:2,100',
      'email'      => 'required|email|max:255',
      'phone'      => 'required|string|digits_between:10,12',
      'address_1'  => 'required|string|between:6,150',
      'city'       => 'required|string|max:25',
      'state'      => 'required|string|size:2',
      'zip'        => 'required|numeric|digits:5',
      'country'    => 'required|size:2',
      'card_name'  => 'required|alpha|between:2,100',
      'card_no'    => 'required|numeric|digits:16',
      'card_month' => 'required|numeric|digits:2',
      'card_year'  => 'required|numeric|digits:2',
      'cvc'        => 'required|numeric|digits:3',
    ]);

    $stripe_secret_key = env('STRIPE_SECRET_KEY');

    Stripe::setApiKey($stripe_secret_key);

    try {
      $charge = Charge::create(array(
        "amount"      => $cart->total_price * 100,
        "currency"    => "usd",
        "source"      => $request->input('stripe_token'), // generated from checkout.js
        "description" => "Test Charge",
      ));

      if ($charge->id)
      {
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
    }
    catch (\Exception $e)
    {
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }

    Session::forget('cart');

    return redirect('cart')->with('success', 'Payment successful.');
  }
}
