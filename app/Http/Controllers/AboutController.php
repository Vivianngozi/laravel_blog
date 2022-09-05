<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomeAbout;

use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    //
    public function HomeAbout() {

        $homeabout = HomeAbout::latest()->get();

        return view('admin.about.index', compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(REQUEST $request) {

        $validate = $request->validate([

            'title' => 'required|unique:home_abouts|max: 255',
            'short_dis' => 'required|min: 10',
            'long_dis' => 'required|min: 10',
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now(),
        ]);
        return Redirect()->route('home.about')->with('success', 'Inserted Successfully');
    }

    public function EditAbout($id) {

        $homeabout = HomeAbout::findOrFail($id);

        return view('admin.about.edit', compact('homeabout'));
    }

    public function UpdateAbout(REQUEST $request, $id) {

        $homeabout = HomeAbout::findOrFail($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
        ]);
        return Redirect()->route('home.about')->with('success', 'Updated Successfully');
    }

    public function DeleteAbout($id) {

        $homeabout = HomeAbout::findOrFail($id)->delete();

        return Redirect()->route('home.about')->with('success', 'Deleted Successfully');

    }
}
