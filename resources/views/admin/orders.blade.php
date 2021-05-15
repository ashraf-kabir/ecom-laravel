@extends('admin_layouts.app')

@section('title')
    Orders
@endsection

@section('admin_content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Orders</h4>
    
    @if (Session::has('error'))
        <div class="alert alert-danger">
          {{Session::get('error')}}
        </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                  <th>Order #</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Customer Phone</th>
                  <th>Cart</th>
                  <th>Payment ID</th>
                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                  <tr>
                      <td>{{$order->id}}</td>
                      <td>{{$order->name}}</td>
                      <td>{{$order->email}}</td>
                      <td>{{$order->phone}}</td>
                      <td>
                        @foreach ($order->cart->items as $item)
                            {{$item['product_name'] . ', '}}
                        @endforeach
                      </td>
                      <td>{{$order->payment_id}}</td>
                      <td>
                        <a class="btn btn-outline-primary" href="{{url('admin/orders/view_pdf/'.$order->id)}}" target="_blank">View</a>
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('admin/js/data-table.js') }}"></script>
@endsection