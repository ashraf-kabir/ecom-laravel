<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PdfController extends Controller
{
  public function view_pdf($id)
  {
    Session::put('id', $id);
    try {
      $pdf = App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
      $pdf->loadHTML($this->convert_orders_data_to_html());

      return $pdf->stream();
    }
    catch (\Exception $e)
    {
      return redirect::to('/admin/orders')->with('error', $e->getMessage());
    }
  }

  public function convert_orders_data_to_html()
  {
    $orders = Order::where('id', Session::get('id'))->get();

    $order_no         = '';
    $customer_name    = 'N/A';
    $customer_phone   = 'N/A';
    $customer_email   = 'N/A';
    $customer_address = 'N/A';
    $customer_city    = 'N/A';
    $customer_state   = 'N/A';
    $customer_zip     = 'N/A';
    $customer_country = 'N/A';
    $created_at       = '';

    foreach ($orders as $order)
    {
      $order_no         = $order->id;
      $customer_name    = $order->name;
      $customer_phone   = $order->phone;
      $customer_email   = $order->email;
      $customer_address = $order->address;
      $customer_city    = $order->city;
      $customer_state   = $order->state;
      $customer_zip     = $order->zip;
      $customer_country = $order->country;
      $created_at       = $order->created_at;
    }

    $orders->transform(function ($order, $key)
    {
      $order->cart = unserialize($order->cart);

      return $order;
    });

    $output = '<link rel="stylesheet" href="frontend/css/style.css">
                  <h4 class="text-center">Order # ' . $order_no . '</h4>
                  <table class="table">
                      <thead class="thead">
                          <tr class="text-left">
                              <th>Client Name: ' . $customer_name . '<br> Email: ' . $customer_email .
                                  ' <br> Phone: ' . $customer_phone . '<br> Address: ' . $customer_address .
                                  ' <br> City: ' . $customer_city . ' <br> State: ' . $customer_state .
                                  ' <br> Zip: ' . $customer_zip . ' <br> Country: ' . $customer_country .
                                  ' <br> Date: ' . $created_at . '</th>
                          </tr>
                      </thead>
                  </table>
                  <table class="table">
                      <thead class="thead-primary">
                          <tr class="text-center">
                              <th>Image</th>
                              <th>Product Name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>';

    foreach ($orders as $order)
    {
      foreach ($order->cart->items as $item)
      {

        $output .= '<tr class="text-center">
                        <td class="image-prod"><img src="./storage/' . $item['product_image'] . '" alt="" style = "height: 80px; width: 80px;"></td>
                        <td class="product-name">
                            <h3>' . $item['product_name'] . '</h3>
                        </td>
                        <td class="price">$ ' . $item['product_price'] . '</td>
                        <td class="qty">' . $item['qty'] . '</td>
                        <td class="total">$ ' . $item['product_price'] * $item['qty'] . '</td>
                    </tr>
                </tbody>';

      }

      $total_price = $order->cart->total_price;

    }

    $output .= '</table>';

    $output .= '<table class="table">
                    <thead class="thead">
                        <tr class="text-center">
                            <th>Total</th>
                            <th>$ ' . $total_price . '</th>
                        </tr>
                    </thead>
                </table>';

    return $output;
  }

}
