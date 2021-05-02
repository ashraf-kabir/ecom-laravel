@extends('admin_layouts.app')

@section('title')
    Add Category
@endsection

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Category</h4>

          {{-- @if (Session::has('status_1'))
            <div class="alert alert-success">
              {{Session::get('status_1')}}
            </div>
          @endif

          @if (Session::has('status_2'))
            <div class="alert alert-danger">
              {{Session::get('status_2')}}
            </div>
          @endif --}}

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::open(['action' => ['App\Http\Controllers\CategoryController@update', $category->id], 'class' => 'edit_category_form', 'method' => 'PUT', 'id' => 'edit_category_form'])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Category Name', ['for' => 'category_name'])}}
                {{Form::text('category_name', $category->category_name, ['class' => 'form-control', 'minlength' => '2', 'id' => 'category_name'])}}
              </div>
              {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
          {!!Form::close()!!}

        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('admin/js/bt-maxLength.js') }}"></script>
@endsection