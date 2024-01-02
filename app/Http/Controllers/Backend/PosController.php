<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function Pos() {

        $product = Product::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page', compact('product', 'customer'));
    }

    public function AddCart(Request $request) {

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => ['size' => 'large']
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllItem() {

        $product_item = Cart::content();

        return view('backend.pos.text_item', compact('product_item'));
    }

    public function CartUpdate(Request $request,$rowId) {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        $notification = array(
            'message' => 'Cart Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}