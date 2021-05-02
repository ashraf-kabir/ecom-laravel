<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Category::get();
    return view('admin.categories')->with('categories', $categories);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.addcategory');
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
      'category_name' => 'required|unique:categories|max:255',
    ]);
    $category = new Category();
    $category->category_name = $request->input('category_name');
    $category->save();
    return redirect('admin/categories')->with('status_1', 'The "' . $category->category_name . '" category added successfully.');
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
    $category = Category::find($id);
    return view('admin.editcategory')->with('category', $category);
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
      'category_name' => 'required|unique:categories|max:255',
    ]);
    $category                = Category::find($id);
    $category->category_name = $request->input('category_name');
    $category->update();
    return redirect('admin/categories')->with('status_1', 'The "' . $category->category_name . '" category updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();
    return redirect('admin/categories')->with('status_1', 'The "' . $category->category_name . '" category deleted successfully.');
  }
}
