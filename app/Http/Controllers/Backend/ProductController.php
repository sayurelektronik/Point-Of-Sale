<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AllProduct() {

        $product = Product::latest()->get();

        return view('backend.product.all_product', compact('product'));
    }

    public function AddProduct() {

        $supplier = Supplier::latest()->get();
        $category = Category::latest()->get();

        return view('backend.product.add_product', compact('supplier', 'category'));
    }

    public function StoreProduct(Request $request)
    {
        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
        $save_url = 'upload/product/' . $name_gen;

        Product::insert([

            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }
}