<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
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
      'cvc'        => 'required|numeric|digits:3'
    ]);

    $stripe_secret_key = env('STRIPE_SECRET_KEY');

    $stripe = new \Stripe\StripeClient(
      $stripe_secret_key
    );

    try {
      $charge = $stripe->charges->create([
        'amount'      => $cart->total_price * 100,
        'currency'    => 'usd',
        'source'      => $request->input('stripe_token'), // generated from checkout.js
        'description' => 'Test Charge'
      ]);

      if (isset($charge['id']))
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
        $order->payment_id = $charge['id'];

        $order->save();
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
