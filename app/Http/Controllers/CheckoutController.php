<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

// use Stripe\Charge;
// use Stripe\Stripe;

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
    // dd($request);
    if (!Session::has('cart'))
    {
      return redirect::to('/cart');
      // , ['Products' => null]
    }

    $old_cart = Session::get('cart');
    $cart     = new Cart($old_cart);

    $user = Session::get('client');
    // echo '<pre>';
    // print_r($cart->product_id);
    // die();

    $request->validate([
      'first_name' => 'required',
      'last_name'  => 'required',
      'email'      => 'required|email|max:255',
      'phone'      => 'required',
      'address_1'  => 'required',
      'city'       => 'required',
      'state'      => 'required',
      'zip'        => 'required',
      'country'    => 'required',
      'card_name'  => 'required',
      'card_no'    => 'required',
      'card_month' => 'required',
      'card_year'  => 'required',
      'cvc'        => 'required'
    ]);

    $total_price = (float) $cart->total_price;

    // var_dump($total_price);
    // die();

    $stripe_secret_key = env('STRIPE_SECRET_KEY');

    $stripe = new \Stripe\StripeClient(
      $stripe_secret_key
    );

    try {
      $charge = $stripe->charges->create([
        'amount'      => $total_price * 100,
        'currency'    => 'usd',
        'source'      => $request->input('stripe_token'), // generated from checkout.js
        'description' => 'Test Charge'
      ]);

      if (isset($charge['id']))
      {
        $order = new Order();

        $order->name          = $request->input('first_name') . ' ' . $request->input('last_name');
        $order->email         = $request->input('email');
        $order->phone         = $request->input('phone');
        $order->address       = $request->input('address_1') . ' ' . $request->input('address_2');
        $order->city          = $request->input('city');
        $order->state         = $request->input('state');
        $order->zip           = $request->input('zip');
        $order->country       = $request->input('country');
        $order->cart          = serialize($cart);
        $order->payment_id    = $charge['id'];
        $order->checkout_type = 1;       // 1 -> self
        $order->user_id       = $user->id;

        $order->save();

        $transaction = new Transactions();

        $transaction->subtotal     = $total_price;
        $transaction->tax          = 0;
        $transaction->discount     = 0;
        $transaction->total        = $total_price;
        $transaction->payment_id   = $charge['id'];
        $transaction->payment_type = 1;       // 1 -> card, 2 -> cash
        $transaction->user_id      = $user->id;

        $transaction->save();
      }
      else
      {
        return redirect('checkout')->with('error', 'Payment failed.');
      }
    }
    catch (\Stripe\Exception\CardException $e)
    {
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Stripe\Exception\RateLimitException $e)
    {
      // Too many requests made to the API too quickly
      // echo 'Message is:' . $e->getError()->message . '\n';

      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Stripe\Exception\InvalidRequestException $e)
    {
      // Invalid parameters were supplied to Stripe's API
      // echo 'Message is:' . $e->getError()->message . '\n';

      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Stripe\Exception\AuthenticationException $e)
    {
      // Authentication with Stripe's API failed
      // (maybe you changed API keys recently)
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Stripe\Exception\ApiConnectionException $e)
    {
      // Network communication with Stripe failed
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Stripe\Exception\ApiErrorException $e)
    {
      // Display a very generic error to the user, and maybe send
      // yourself an email
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }
    catch (\Exception $e)
    {
      // echo '<pre>';
      // print_r($e);
      // die();
      Session::put('error', $e->getMessage());
      return redirect::to('/checkout');
    }

    Session::forget('cart');

    return redirect('cart')->with('success', 'Payment successful.');
  }
}
