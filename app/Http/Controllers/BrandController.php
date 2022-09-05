<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Multipic;

use Illuminate\Support\Carbon;

use Image;

use Auth;

class BrandController extends Controller
{
    //Access control

    public function __construct() {

        $this->middleware('auth');
    }

    public function AllBrand() {

        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request) {

        $validate = $request->validate([

            'brand_name' => 'required|unique:brands|min: 5',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],

        [
            'brand_name.required' => 'Please, Input Brand Name', 
            'brand_name.min' => 'Characters must be more than 5',
        ]
    
        );

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());

        // $img_ext = strtolower($brand_image->getClientOriginalExtension());

        // $img_name = $name_gen. ".".$img_ext;

        // $up_location = 'image/brand/';

        // $last_img = $up_location.$img_name;

        // $brand_image->move($up_location,$img_name);

        // using resize package

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();

        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,

            'brand_image' => $last_img,

            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    
    }

    public function Edit($id) {

        $brands = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id) {

        

        $validate = $request->validate([

            'brand_name' => 'required|min: 5',
            
        ],

        [
            'brand_name.required' => 'Please, Input Brand Name', 
            'brand_name.min' => 'Characters must be more than 5',
        ]
    
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());

            $img_ext = strtolower($brand_image->getClientOriginalExtension());

            $img_name = $name_gen. ".".$img_ext;

            $up_location = 'image/brand/';

            $last_img = $up_location.$img_name;

            $brand_image->move($up_location,$img_name);

            unlink($old_image);

            Brand::findOrFail($id)->update([
            'brand_name' => $request->brand_name,

            'brand_image' => $last_img,

            'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand Updated Successfully');
        }else{

            Brand::findOrFail($id)->update([
                'brand_name' => $request->brand_name,
    
                'created_at' => Carbon::now()
                ]);
    
                return Redirect()->back()->with('success', 'Brand Updated Successfully');
        }

        
    }

    public function Delete($id){

        $image = Brand::findOrFail($id);

        $old_image = $image->brand_image;

        unlink($old_image);

        Brand::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    //This is multi image section

    public function Multipic() {

        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }


    public function StoreImage(Request $request) {

        $images =  $request->file('image');

        foreach($image as $multi_img){ 

        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(200,200)->save('image/multi/'.$name_gen);

        $last_img = 'image/multi/'.$name_gen;
 
        Multipic::insert([
           
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
            }

        return Redirect()->back()->with('success', 'Weldone babe');
    }


    public function Logout() {

        Auth::Logout();

        return Redirect()->route('login')->with('success', 'User Logged logout');
    }
}
