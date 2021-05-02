<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::with('category')->get();
    return view('admin.products')->with('products', $products);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::All()->pluck('category_name', 'id');
    return view('admin.addproduct')->with('categories', $categories);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'product_name'        => 'required|unique:products|max:255',
      'product_price'       => 'required|numeric',
      'product_image'       => 'nullable|mimes:jpg,png,jpeg|max:1024',
      'product_category_id' => 'required|numeric',
    ]);

    if ($request->hasFile('product_image'))
    {
      $file_name_with_ext  = $request->file('product_image')->getClientOriginalName();
      $file_name           = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
      $extension           = $request->file('product_image')->getClientOriginalExtension();
      $file_name_formatted = $file_name . '_' . time() . '.' . $extension;
      $image_path          = $request->file('product_image')->storeAs('public/uploads/product_images', $file_name_formatted);
    }
    else
    {
      $image_path = 'no_image.jpg';
    }

    $product = new Product();

    $product->product_name        = $request->input('product_name');
    $product->product_price       = $request->input('product_price');
    $product->product_category_id = $request->input('product_category_id');
    $product->product_image       = $image_path;
    $product->product_status      = 1;

    $product->save();

    return redirect('admin/products')->with('status_1', 'The "' . $product->product_name . '" product added successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
