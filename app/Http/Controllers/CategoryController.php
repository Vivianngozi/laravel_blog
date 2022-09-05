<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    //middlewear Auth User Access control

    public function __construct() {

        $this->middleware('auth');
    }
    //
    public function AllCat() {

        // $categories = Category::all();

        //for show the lastest
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);

        // query builder method

        // $categories = DB::table('categories')->latest()->get();

        //pagination
        // $categories = DB::table('categories')->latest()->paginate(5);

        //for joining 2 tables using query builder

        // $categories = DB::table('categories')
        //               ->join('users', 'categories.user_id', 'users.id')
        //               ->select('categories.*', 'users.name')
        //               ->latest()->paginate(5);


        //To display trash data
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            
        ],
        
        // Use to make your own custom messages
         
        [
            'category_name.required' => 'Please, input the category name.',

            'category_name.max' => 'Category name is more than 255 characters',
            
        ]
    );
     

    // eloquent method of storing data
    Category::insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now() 
    ]);

    
    //This method is more professional

    // $category = new Category;

    // $category->category_name = $request->category_name;

    // $category->user_id = Auth::user()->id;

    // $category->save();


    //Query Builder

    // $data = array();

    // $data['category_name'] = $request->category_name;

    // $data['user_id'] = Auth::user()->id;

    // DB::table('categories')->insert($data);


    return redirect()->back()->with('success', 'Category Inserted Successfully');
    } 

    public function Edit($id){
        // $categories = Category::findOrFail($id);
        
        // Query builder
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('categories'));
    }
    public function Update(Request $request, $id) {
        // $update = Category::findOrFail($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);

        // QB
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;

        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id) {
        $delete = Category::findOrFail($id)->delete();

        return Redirect()->back()->with('success', 'Category has been moved to Trash');
    }

    public function Delete($id) {
        $delete = Category::onlyTrashed()->findOrFail($id)->forceDelete();

        return Redirect()->back()->with('success', 'Category deleted permanently');
    }

    public function Restore($id) {
        $delete = Category::withTrashed()->findOrFail($id)->restore();

        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }
}
