@extends('admin_layouts.app')

@section('title')
    Edit Product
@endsection

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Product</h4>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::open(['action' => ['App\Http\Controllers\ProductController@update', $product->id], 'class' => 'edit_product_form', 'method' => 'PUT', 'enctype' => 'multipart', 'files' => true])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Product Name', ['for' => 'product_name'])}}
                {{Form::text('product_name', $product->product_name, ['class' => 'form-control', 'minlength' => '2', 'id' => 'product_name'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Category', ['for' => 'product_category'])}}
                {{Form::select('category_id', $categories, $product->category->id, ['class' => 'form-control', 'id' => 'product_category'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Price', ['for' => 'product_price'])}}
                {{Form::text('product_price', $product->product_price, ['class' => 'form-control', 'id' => 'product_price'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Length (inches)', ['for' => 'product_length'])}}
                {{Form::text('product_length', $product->product_length, ['class' => 'form-control', 'id' => 'product_length'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Width (inches)', ['for' => 'product_width'])}}
                {{Form::text('product_width', $product->product_width, ['class' => 'form-control', 'id' => 'product_width'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Height (inches)', ['for' => 'product_height'])}}
                {{Form::text('product_height', $product->product_height, ['class' => 'form-control', 'id' => 'product_height'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Weight (pounds)', ['for' => 'product_weight'])}}
                {{Form::text('product_weight', $product->product_weight, ['class' => 'form-control', 'id' => 'product_weight'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Quantity', ['for' => 'product_quantity'])}}
                {{Form::text('product_quantity', $product->product_quantity, ['class' => 'form-control', 'id' => 'product_quantity'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Description', ['for' => 'product_description'])}}
                {{Form::textarea('product_description', $product->product_description, ['class' => 'form-control', 'id' => 'product_description'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Image', ['for' => 'product_image'])}}

                <div class="row ml-2 mb-1">
                  <img class="float-right" src="{{ asset($product->product_image) }}" alt="{{$product->product_name}}"
                    onerror="if (this.src != '/uploads/no_image.jpg') this.src = '/uploads/no_image.jpg';"
                    width="50" height="50" />
                </div>

                {{Form::file('product_image', ['class' => 'form-control', 'id' => 'product_image'])}}
              </div>

              {{-- <div class="form-group">
                {{Form::label('', 'Product Status', ['for' => 'product_status'])}}
                {{Form::checkbox('product_status', '', 'true', ['class' => 'form-control', 'id' => 'product_status'])}}
              </div> --}}

              {{Form::submit('Update', ['class' => 'btn btn-success'])}}
          {!!Form::close()!!}

        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="js/bt-maxLength.js"></script>
@endsection