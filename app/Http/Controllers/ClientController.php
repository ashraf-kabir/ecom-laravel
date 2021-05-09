<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class ClientController extends Controller
{
  public function home()
  {
    $sliders  = Slider::get();
    $products = Product::get();
    return view('client.home')->with('sliders', $sliders)->with('products', $products);
  }

  public function shop()
  {
    $products   = Product::get();
    $categories = Category::get();
    return view('client.shop')->with('products', $products)->with('categories', $categories);
  }

  public function shop_by_category($id)
  {
    $categories = Category::get();
    $products   = Product::with('category')->where('category_id', $id)->get();
    return view('client.shop')->with('products', $products)->with('categories', $categories);
  }

  public function login()
  {
    return view('client.login');
  }

  public function signup()
  {
    return view('client.signup');
  }
}
