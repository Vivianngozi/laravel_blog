<?php

namespace App\Http\Controllers;

use App\Models\HomeService;

use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function HomeService() {

        $homeservice = HomeService::latest()->get();

        return view('admin.service.index', compact('homeservice'));
    }
    public function AddService() {
        return view('admin.service.create');
    }

    public function StoreService(REQUEST $request) {
        $validate = $request->validate([
            'title' => 'required|unique:home_services|min: 5',
            'desc' => 'required|max: 255',
        ]);

        $homeservice = HomeService::insert([
            'title' => $request->title,
            'desc' => $request->desc,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.service')->with('success', 'Inserted Successfully');
    }

    public function EditService($id) {

        $homeservice = HomeService::findOrFail($id);

        return view('admin.service.edit', compact('homeservice'));
    }

    public function UpdateService(REQUEST $request, $id) {
        $validate = $request->validate([
            'title' => 'required|unique:home_services|min: 5',
            'desc' => 'required|max: 255',
        ]);

        $homeservice = HomeService::findOrFail($id)->update([

            'title' =>$request->title,
            'desc' =>$request->desc,
            
        ]);

        return Redirect()->route('home.service')->with('success', 'Updated');
    }

    public function DeleteService($id) {

        $homeservice = HomeService::findOrFail($id)->delete();

        return Redirect()->route('home.service')->with('success', 'Deleted');
    }
}
