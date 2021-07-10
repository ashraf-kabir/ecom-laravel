@extends('admin_layouts.app')

@section('title')
    Categories
@endsection

@section('admin_content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Categories</h4>

    @if (Session::has('status_1'))
      <div class="alert alert-success">
        {{Session::get('status_1')}}
      </div>
    @endif

    @if (Session::has('status_2'))
      <div class="alert alert-danger">
        {{Session::get('status_2')}}
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                  <th>ID #</th>
                  <th>Category Name</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->category_name}}</td>
                  <td>
                    <a class="btn btn-outline-primary" href="{{url('admin/category/edit/'.$category->id)}}" target="_blank">Edit</a>
                    <a class="btn btn-outline-danger" href="/admin/category/delete/{{$category->id}}" id="delete">Delete</a>
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