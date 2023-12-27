<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory() {

        $category = Category::latest()->get();
        return view('backend.category.all_category', compact('category'));
    }

    public function StoreCategory(Request $request) {

        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id) {

        $category = Category::findOrFail($id);

        return view('backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request) {

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id) {

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}