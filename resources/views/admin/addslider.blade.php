@extends('admin_layouts.app')

@section('title')
    Add Slider
@endsection

@section('admin_content')
  <div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Slider</h4>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {!!Form::open(['action' => 'App\Http\Controllers\SliderController@store', 'class' => 'create_slider_form', 'method' => 'POST', 'id' => 'create_slider_form', 'enctype' => 'multipart', 'files' => true])!!}
            {{csrf_field()}}
              <div class="form-group">
                {{Form::label('', 'Description One', ['for' => 'description_one'])}}
                {{Form::text('description_one', '', ['class' => 'form-control', 'id' => 'description_one', 'minlength' => '5'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Description Two', ['for' => 'description_two'])}}
                {{Form::text('description_two', '', ['class' => 'form-control', 'id' => 'description_two', 'minlength' => '5'])}}
              </div>

              <div class="form-group">
                {{Form::label('', 'Slider Image', ['for' => 'slider_image'])}}
                {{Form::file('slider_image', ['class' => 'form-control', 'id' => 'slider_image'])}}
              </div>

              {{-- <div class="form-group">
                {{Form::label('', 'Slider Status', ['for' => 'cname'])}}
                {{Form::checkbox('slider_status', '', 'true', ['class' => 'form-control'])}}
              </div> --}}

              {{Form::submit('Save', ['class' => 'btn btn-success'])}}
          {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('admin/js/bt-maxLength.js') }}"></script>
@endsection