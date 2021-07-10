<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
      'product_name'        => 'required|max:255',
      'category_id'         => 'required|numeric',
      'product_price'       => 'required|numeric',
      'product_image'       => 'nullable|mimes:jpg,png,jpeg|max:1024',
      'product_length'      => 'required|numeric',
      'product_width'       => 'required|numeric',
      'product_height'      => 'required|numeric',
      'product_weight'      => 'required|numeric',
      'product_quantity'    => 'required|numeric',
      'product_description' => 'required'
    ]);

    if (!file_exists('uploads/product_images'))
    {
      mkdir('uploads/product_images', 0777, true);
    }

    if ($request->hasFile('product_image'))
    {
      $product_image          = $request->product_image;
      $product_image_new_name = time() . '_' . $product_image->getClientOriginalName();
      $product_image->move('uploads/product_images', $product_image_new_name);

      $image_path = 'uploads/product_images/' . $product_image_new_name;
    }
    else
    {
      $image_path = 'uploads/no_image.jpg';
    }

    $product = new Product();

    $product->product_name        = $request->input('product_name');
    $product->category_id         = $request->input('category_id');
    $product->product_price       = $request->input('product_price');
    $product->product_length      = $request->input('product_length');
    $product->product_width       = $request->input('product_width');
    $product->product_height      = $request->input('product_height');
    $product->product_weight      = $request->input('product_weight');
    $product->product_quantity    = $request->input('product_quantity');
    $product->product_description = $request->input('product_description');
    $product->product_image       = $image_path;
    $product->status              = 1;

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
    $product = Product::with('category')->find($id);

    return view('admin.viewproduct')->with('product', $product);
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
    $request->validate([
      'product_name'        => 'required|max:255',
      'category_id'         => 'required|numeric',
      'product_price'       => 'required|numeric',
      'product_image'       => 'nullable|mimes:jpg,png,jpeg|max:1024',
      'product_length'      => 'required|numeric',
      'product_width'       => 'required|numeric',
      'product_height'      => 'required|numeric',
      'product_weight'      => 'required|numeric',
      'product_quantity'    => 'required|numeric',
      'product_description' => 'required'
    ]);

    $product = Product::find($id);

    $product->product_name        = $request->input('product_name');
    $product->category_id         = $request->input('category_id');
    $product->product_price       = $request->input('product_price');
    $product->product_length      = $request->input('product_length');
    $product->product_width       = $request->input('product_width');
    $product->product_height      = $request->input('product_height');
    $product->product_weight      = $request->input('product_weight');
    $product->product_quantity    = $request->input('product_quantity');
    $product->product_description = $request->input('product_description');

    $prev_img = $product->product_image;

    if ($request->hasFile('product_image'))
    {
      $product_image          = $request->product_image;
      $product_image_new_name = time() . '_' . $product_image->getClientOriginalName();
      $product_image->move('uploads/product_images', $product_image_new_name);
      $image_path             = 'uploads/product_images/' . $product_image_new_name;
      $product->product_image = $image_path;

      if ($prev_img != 'uploads/no_image.jpg')
      {
        if (file_exists($prev_img))
        {
          unlink($prev_img);
        }
      }
    }

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
    $product = Product::find($id);

    $prev_img = $product->product_image;

    if ($prev_img != 'uploads/no_image.jpg')
    {
      if (file_exists($prev_img))
      {
        unlink($prev_img);
      }
    }

    $product->delete();
    return redirect('admin/products')->with('status_1', 'The "' . $product->product_name . '" product deleted successfully.');
  }

  /**
   * @param $id
   */
  public function activate($id)
  {
    $product         = Product::find($id);
    $product->status = 1;
    $product->update();
    return redirect('admin/products')->with('status_1', 'The "' . $product->product_name . '" product activated successfully.');
  }

  /**
   * @param $id
   */
  public function deactivate($id)
  {
    $product         = Product::find($id);
    $product->status = 0;
    $product->update();
    return redirect('admin/products')->with('status_1', 'The "' . $product->product_name . '" product deactivated successfully.');
  }
}
