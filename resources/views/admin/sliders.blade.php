@extends('admin_layouts.app')

@section('title')
    Sliders
@endsection

@section('admin_content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Sliders</h4>

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
                  <th>Description One</th>
                  <th>Slider Image</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sliders as $slider)
                <tr>
                    <td>{{$slider->id}}</td>
                    <td>{{$slider->description_one}}</td>
                    <td><img src="/storage/{{$slider->slider_image}}" alt="{{$slider->slider_name}}" width="50" height="50"></td>
                    <td>
                      @if ($slider->status == 1)
                        <label class="badge badge-success">Activated</label>
                      @else
                        <label class="badge badge-danger">Deactivated</label>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-outline-primary" onclick="window.location = '{{url('admin/slider/edit/'.$slider->id)}}'">Edit</button>
                      <a class="btn btn-outline-danger" href="/admin/slider/delete/{{$slider->id}}" id="delete">Delete</a>
                      @if ($slider->status == 1)
                        <button class="btn btn-outline-warning" onclick="window.location = '{{url('admin/slider/deactivate/'.$slider->id)}}'">Deactivate</button>                    
                      @else
                        <button class="btn btn-outline-success" onclick="window.location = '{{url('admin/slider/activate/'.$slider->id)}}'">Activate</button>
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