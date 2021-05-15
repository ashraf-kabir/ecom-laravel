<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function dashboard()
  {
    return view('admin.dashboard');
  }

  public function add_category()
  {
    return view('admin.addcategory');
  }

  public function add_product()
  {
    return view('admin.addproduct');
  }

  public function add_slider()
  {
    return view('admin.addslider');
  }
}
