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
          {!!Form::open(['action' => 'App\Http\Controllers\AdminController@add_product', 'class' => 'cmxform', 'method' => 'POST', 'id' => 'commentForm'])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Product Name', ['for' => 'cname'])}}
                {{Form::text('product_name', '', ['class' => 'form-control'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Price', ['for' => 'cname'])}}
                {{Form::number('product_price', '', ['class' => 'form-control'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Category', ['for' => 'cname'])}}
                {{Form::select('size', ['L' => 'Large', 'S' => 'Small',], null, ['placeholder' => 'Select Category', 'class' => 'form-control'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Image', ['for' => 'cname'])}}
                {{Form::file('product_image', ['class' => 'form-control'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Product Status', ['for' => 'cname'])}}
                {{Form::checkbox('product_status', '', 'true', ['class' => 'form-control'])}}
              </div>

              {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
@endsection
