<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
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
    $sliders = Slider::get();
    return view('admin.sliders')->with('sliders', $sliders);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.addslider');
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
      'description_one' => 'required|max:30',
      'description_two' => 'required|max:60',
      'slider_image'    => 'required|mimes:jpg,png,jpeg|max:1024',
    ]);

    if (!file_exists('uploads/slider_images'))
    {
      mkdir('uploads/slider_images', 0777, true);
    }

    if ($request->hasFile('slider_image'))
    {
      $slider_image          = $request->slider_image;
      $slider_image_new_name = time() . '_' . $slider_image->getClientOriginalName();
      $slider_image->move('uploads/slider_images', $slider_image_new_name);

      $image_path = 'uploads/slider_images/' . $slider_image_new_name;
    }
    else
    {
      $image_path = 'uploads/slider_images/no_image.jpg';
    }

    $slider = new Slider();

    $slider->description_one = $request->input('description_one');
    $slider->description_two = $request->input('description_two');
    $slider->slider_image    = $image_path;
    $slider->status          = 1;

    $slider->save();

    return redirect('admin/sliders')->with('status_1', 'The slider added successfully.');
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
    $slider = Slider::find($id);
    return view('admin.editslider')->with('slider', $slider);
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
      'description_one' => 'required|max:30',
      'description_two' => 'required|max:60',
      'slider_image'    => 'nullable|mimes:jpg,png,jpeg|max:1024',
    ]);

    $slider = Slider::find($id);

    $slider->description_one = $request->input('description_one');
    $slider->description_two = $request->input('description_two');

    $prev_img = $slider->slider_image;

    if ($request->hasFile('slider_image'))
    {
      $slider_image          = $request->slider_image;
      $slider_image_new_name = time() . '_' . $slider_image->getClientOriginalName();
      $slider_image->move('uploads/slider_images', $slider_image_new_name);
      $image_path           = 'uploads/slider_images/' . $slider_image_new_name;
      $slider->slider_image = $image_path;

      if ($prev_img != 'uploads/no_image.jpg')
      {
        if (file_exists($prev_img))
        {
          unlink($prev_img);
        }
      }
    }

    $slider->update();
    return redirect('admin/sliders')->with('status_1', 'The slider updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $slider = Slider::find($id);

    $prev_img = $slider->slider_image;

    if ($prev_img != 'uploads/no_image.jpg')
    {
      if (file_exists($prev_img))
      {
        unlink($prev_img);
      }
    }

    $slider->delete();
    return redirect('admin/sliders')->with('status_1', 'The slider deleted successfully.');
  }

  public function activate($id)
  {
    $slider         = Slider::find($id);
    $slider->status = 1;
    $slider->update();
    return redirect('admin/sliders')->with('status_1', 'The slider activated successfully.');
  }

  public function deactivate($id)
  {
    $slider         = Slider::find($id);
    $slider->status = 0;
    $slider->update();
    return redirect('admin/sliders')->with('status_1', 'The slider deactivated successfully.');
  }
}
