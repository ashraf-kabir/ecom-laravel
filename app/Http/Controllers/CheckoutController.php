<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Traits\StripeTrait;
use App\Models\Order;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
  use StripeTrait;

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

    $total_price       = (float) $cart->total_price;
    $stripe_card_token = $request->input('stripe_token');

    // var_dump($total_price);
    // die();

    $response = $this->stripe_charge($total_price, $stripe_card_token);

    if (isset($response['success']))
    {
      DB::beginTransaction();

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
      $order->payment_id    = $response['charge']->id;
      $order->checkout_type = 1; // 1 -> self
      $order->user_id       = $user->id;

      $check_order_save = $order->save();

      if ($check_order_save)
      {
        $transaction = new Transactions();

        $transaction->subtotal     = $total_price;
        $transaction->tax          = 0;
        $transaction->discount     = 0;
        $transaction->total        = $total_price;
        $transaction->payment_id   = $response['charge']->id;
        $transaction->payment_type = 1; // 1 -> card, 2 -> cash
        $transaction->user_id      = $user->id;

        $check_transaction_save = $transaction->save();

        if ($check_transaction_save)
        {
          DB::commit();
          Session::forget('cart');
          return redirect('cart')->with('success', 'Payment successful.');
        }
        else
        {
          DB::rollback();
          return redirect('checkout')->with('error', 'Payment failed.');
        }
      }
      else
      {
        DB::rollback();
        return redirect('checkout')->with('error', 'Payment failed.');
      }
    }
    else
    {
      Session::put('error', $response['error_msg']);
      return redirect::to('/checkout');
    }
  }
}
