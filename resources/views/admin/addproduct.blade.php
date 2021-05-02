@extends('admin_layouts.app')

@section('title')
    Add Product
@endsection

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Product</h4>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::open(['action' => 'App\Http\Controllers\ProductController@store', 'class' => 'add_product_form', 'method' => 'POST', 'enctype' => 'multipart', 'files' => true])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Product Name', ['for' => 'product_name'])}}
                {{Form::text('product_name', '', ['class' => 'form-control', 'minlength' => '2', 'id' => 'product_name'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Price', ['for' => 'product_price'])}}
                {{Form::text('product_price', '', ['class' => 'form-control', 'id' => 'product_price'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Category', ['for' => 'product_category'])}}
                {{Form::select('product_category_id', $categories, null, ['placeholder' => 'Select Category', 'class' => 'form-control', 'id' => 'product_category'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Image', ['for' => 'product_image'])}}
                {{Form::file('product_image', ['class' => 'form-control', 'id' => 'product_image'])}}
              </div>

              {{-- <div class="form-group">
                {{Form::label('', 'Product Status', ['for' => 'product_status'])}}
                {{Form::checkbox('product_status', '', 'true', ['class' => 'form-control', 'id' => 'product_status'])}}
              </div> --}}

              {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
          {!!Form::close()!!}

        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="js/bt-maxLength.js"></script>
@endsection