<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
  public function home()
  {
    $sliders  = Slider::get();
    $products = Product::where('status', 1)->get();
    return view('client.home')->with('sliders', $sliders)->with('products', $products);
  }

  public function shop()
  {
    $products   = Product::where('status', 1)->get();
    $categories = Category::get();
    return view('client.shop')->with('products', $products)->with('categories', $categories);
  }

  public function shop_by_category($id)
  {
    $categories = Category::get();
    $products   = Product::where('status', 1)->with('category')->where('category_id', $id)->get();
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

  public function create_account(Request $request)
  {
    $request->validate([
      'first_name' => 'required|string|between:2,100',
      'last_name'  => 'required|string|between:2,100',
      'phone'      => 'required|string|max:12',
      'email'      => 'required|email|unique:clients,email|max:255',
      'password'   => 'required|min:6',
    ]);

    $client = new Client();

    $client->email    = $request->input('email');
    $client->password = bcrypt($request->input('password'));
    $client->name     = $request->input('first_name') . ' ' . $request->input('last_name');
    $client->phone    = $request->input('phone');

    $client->save();

    return back()->with('success', 'Your account created successfully.');
  }

  public function login_account(Request $request)
  {
    $request->validate([
      'email'    => 'required|email',
      'password' => 'required',
    ]);

    $client = Client::where('email', $request->input('email'))->first();

    if ($client)
    {
      if (Hash::check($request->input('password'), $client->password))
      {
        Session::put('client', $client);

        // if (url()->previous() == URL::to('/') . '/cart')
        // {
        //   return redirect('/checkout');
        // }
        return redirect('/');
        // return back()->with('success', 'Your email is ' . Session::get('client')->email);
      }
      else
      {
        return back()->with('error', 'Email or password didn\'t match! Try again.');
      }
    }
    else
    {
      return back()->with('error', 'Email or password didn\'t match! Try again.');
    }
  }

  public function logout()
  {
    Session::forget('client');
    return Redirect::back();
  }
}
