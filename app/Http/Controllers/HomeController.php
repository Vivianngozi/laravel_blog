<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;

use Image;


class HomeController extends Controller
{
    //
    public function Homeslider() {

        $sliders = Slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider() {

        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request) {
      

        $validate = $request->validate([

            'title' => 'required|unique:sliders|min: 5',
            'description' => 'required|min: 5',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],

        [
            'title.required' => 'Please, Input the title', 
            'description.required' => 'Please, Input Some text', 
            'image.mimes' => 'It can only be jpg,jpeg and png',
        ]
    );
       

        $image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([

            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');


    }

    public function EditSlider($id) {

        $sliders = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('sliders'));
    }

    public function UpdateSlider(Request $request, $id) {

        $validate = $request->validate (
            [
                'title' => 'required|unique:sliders|min: 5',
                'description' => 'required|min:5',
                
            ]
        
            );

            $old_image = $request->old_image;

            $image = $request->file('image');

            if($image){
                $name_gen = hexdec(uniqid());

                $img_ext = strtolower($image->getClientOriginalExtension());

                $img_name = $name_gen.".".$img_ext;

                $up_location = "image/slider/";

                $last_img = $up_location.$img_name;

                $image->move($up_location,$img_name);

                unlink($old_image);

                Slider::findOrFail($id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $last_img,
                    'created_at' => Carbon::now()
                ]);

                return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
            }else{

                Slider::findOrFail($id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
        
                    'created_at' => Carbon::now()
                    ]);
        
                    return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');
            }
            
    }

    public function DeleteSlider($id) {

        $image = Slider::findOrFail($id);

        $old_image = $image->image;

        unlink($old_image);

        Slider::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Deleted');
    }
}
