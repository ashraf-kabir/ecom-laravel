<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
  /**
   * @param $id
   */
  public function add_to_cart($id)
  {
    $product = Product::find($id);
    // print_r($product);

    $old_cart = Session::has('cart') ? Session::get('cart') : null;
    $cart     = new Cart($old_cart);
    $cart->add($product, $id);
    Session::put('cart', $cart);

    // dd(Session::get('cart'));
    return Redirect::back();
  }

  public function cart()
  {
    if (!Session::has('cart'))
    {
      return view('client.cart');
    }

    $old_cart = Session::has('cart') ? Session::get('cart') : null;
    $cart     = new Cart($old_cart);
    return view('client.cart', ['products' => $cart->items]);
  }

  /**
   * @param Request $request
   */
  public function update_qty(Request $request)
  {
    // print('the product id is ' . $request->id . ' And the product qty is ' . $request->quantity);
    $old_cart = Session::has('cart') ? Session::get('cart') : null;
    $cart     = new Cart($old_cart);
    $cart->update_qty($request->id, $request->quantity);
    Session::put('cart', $cart);

    //dd(Session::get('cart'));
    return Redirect::back();
  }

  /**
   * @param $product_id
   */
  public function remove_item($product_id)
  {
    $old_cart = Session::has('cart') ? Session::get('cart') : null;
    $cart     = new Cart($old_cart);
    $cart->remove_item($product_id);

    if (count($cart->items) > 0)
    {
      Session::put('cart', $cart);
    }
    else
    {
      Session::forget('cart');
    }

    //dd(Session::get('cart'));
    return Redirect::back();
  }

}
