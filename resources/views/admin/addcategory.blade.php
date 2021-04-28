@extends('admin_layouts.app')

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Basic form validation</h4>
          {!!Form::open(['action' => 'App\Http\Controllers\AdminController@add_category', 'class' => 'cmxform', 'method' => 'POST', 'id' => 'commentForm'])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Product Category', ['for' => 'cname'])}}
                {{Form::text('category_name', '', ['class' => 'form-control', 'minlength' => '2'])}}
              </div>
              {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
@endsection
