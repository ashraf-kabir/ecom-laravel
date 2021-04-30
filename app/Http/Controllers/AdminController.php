<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
