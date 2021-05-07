<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
      'product_name'  => 'required|unique:products|max:255',
      'product_price' => 'required|numeric',
      'product_image' => 'nullable|mimes:jpg,png,jpeg|max:1024',
      'category_id'   => 'required|numeric',
    ]);

    if ($request->hasFile('product_image'))
    {
      $file_name_with_ext  = $request->file('product_image')->getClientOriginalName();
      $file_name           = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
      $extension           = $request->file('product_image')->getClientOriginalExtension();
      $file_name_formatted = $file_name . '_' . time() . '.' . $extension;
      $image_path          = $request->file('product_image')->storeAs('public/uploads/product_images', $file_name_formatted);
      $image_path_real     = 'uploads/product_images/' . $file_name_formatted;
    }
    else
    {
      $image_path_real = 'uploads/product_images/no_image.jpg';
    }

    $product = new Product();

    $product->product_name   = $request->input('product_name');
    $product->product_price  = $request->input('product_price');
    $product->category_id    = $request->input('category_id');
    $product->product_image  = $image_path_real;
    $product->product_status = 1;

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
    $categories = Category::All()->pluck('category_name', 'id');

    $product = Product::with('category')->find($id);

    return view('admin.editproduct')->with('product', $product)->with('categories', $categories);
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
    // dd($request);
    $request->validate([
      'product_name'  => 'required|max:255',
      'product_price' => 'required|numeric',
      'product_image' => 'nullable|mimes:jpg,png,jpeg|max:1024',
      'category_id'   => 'required|numeric',
    ]);

    $product = Product::find($id);

    $product->product_name  = $request->input('product_name');
    $product->product_price = $request->input('product_price');
    $product->category_id   = $request->input('category_id');

    if ($request->hasFile('product_image'))
    {
      $file_name_with_ext  = $request->file('product_image')->getClientOriginalName();
      $file_name           = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
      $extension           = $request->file('product_image')->getClientOriginalExtension();
      $file_name_formatted = $file_name . '_' . time() . '.' . $extension;
      $image_path          = $request->file('product_image')->storeAs('public/uploads/product_images', $file_name_formatted);

      $old_image = Product::find($id);

      if ($old_image->product_image != 'no_image.jpg')
      {
        Storage::delete('public/' . $old_image->product_image);
      }
      $product->product_image = 'uploads/product_images/' . $file_name_formatted;

    }
    // else
    // {
    //   $image_path = 'no_image.jpg';
    // }

    $product->update();
    return redirect('admin/products')->with('status_1', 'The "' . $product->product_name . '" product updated successfully.');
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
