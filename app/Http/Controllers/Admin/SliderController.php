<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        try{
            $image = $request->file('image');
            $slug = str_slug($request->title);

            if(isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '-' . $image->getClientOriginalExtension();

                if(!file_exists('uploads/slider')) {
                    mkdir('uploads/slider', 0777, true);
                }
                $image->move('uploads/slider', $imageName);
            } else {
                $imageName = 'default.png';
            }

            $slider = new  Slider();
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->image = $imageName;
            $slider->save();

            return redirect()->route('slider.index')->with('success', 'Slider Successfully Saved.');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
        return view('admin.slider.edit', compact('slider'));
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
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        try{
            $image = $request->file('image');
            $slug = str_slug($request->title);
            $slider = Slider::find($id);

            if(isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '-' . $image->getClientOriginalExtension();

                if(!file_exists('uploads/slider')) {
                    mkdir('uploads/slider', 0777, true);
                }
                $image->move('uploads/slider', $imageName);
            } else {
                $imageName = $slider->image;
            }

            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->image = $imageName;
            $slider->save();

            return redirect()->route('slider.index')->with('success', 'Slider Successfully Updated.');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
