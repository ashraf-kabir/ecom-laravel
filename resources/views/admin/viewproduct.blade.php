@extends('admin_layouts.app')

@section('title')
    View Product Details
@endsection

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="mb-4">View Product Details</h5>

          <hr>

          <div class='row mb-4'>
            <div class='col'>
              Product Name
            </div>
            <div class='col'>
              {{ $product->product_name }}
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Category Name
            </div>
            <div class='col'>
              {{ $product->category->category_name }}
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Price
            </div>
            <div class='col'>
              ${{ number_format($product->product_price, 2) }}
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Image
            </div>
            <div class='col'>
              <img class="img-fluid d-block mb-3 mt-3 view-image zoom" src="{{ asset($product->product_image) }}" alt="{{$product->product_name}}"
                    onerror="if (this.src != '/uploads/no_image.jpg') this.src = '/uploads/no_image.jpg';"
                    width="100" height="100" />
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Length 
            </div>
            <div class='col'>
              {{ number_format($product->product_length, 2) }} inches
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Width
            </div>
            <div class='col'>
              {{ number_format($product->product_width, 2) }} inches
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Height
            </div>
            <div class='col'>
              {{ number_format($product->product_height, 2) }} inches
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Weight
            </div>
            <div class='col'>
              {{ number_format($product->product_weight, 2) }} pounds
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Quantity
            </div>
            <div class='col'>
              {{ $product->product_quantity }}
            </div>
          </div>

          <div class='row mb-4'>
            <div class='col'>
              Description
            </div>
            <div class='col'>
              {{ $product->product_description }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="js/bt-maxLength.js"></script>
@endsection