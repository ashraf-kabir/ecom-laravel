@extends('admin_layouts.app')

@section('title')
    Products
@endsection

@section('admin_content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Products</h4>

    @if (Session::has('status_1'))
      <div class="alert alert-success">
        {{Session::get('status_1')}}
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                  <th>ID #</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>${{$product->product_price}}</td>
                  <td>{{$product->category->category_name}}</td>
                  <td><img src="/storage/{{$product->product_image}}" alt="{{$product->product_name}}" width="50" height="50"></td>
                  <td>
                    @if ($product->product_status == 1)
                      <label class="badge badge-success">Activated</label>
                    @else
                      <label class="badge badge-danger">Deactivated</label>
                    @endif
                  </td>
                  <td>
                    <button class="btn btn-outline-primary">Edit</button>
                    <a class="btn btn-outline-danger" href="" id="delete">Delete</a>
                    @if ($product->product_status == 1)
                      <button class="btn btn-outline-warning">Deactivate</button>                    
                    @else
                      <button class="btn btn-outline-success">Activate</button>
                    @endif
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