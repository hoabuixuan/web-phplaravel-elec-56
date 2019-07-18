<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductType;


class CartController extends Controller
{
    public function __construct()
    {
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status', 1)->get();
        $viewData = [
            'category' => $category,
            'producttype' => $producttype,
        ];
        view()->share($viewData);

    }

    public function index()
    {
        $cart = Cart::content();
        return view('client.pages.cart', compact('cart'));
    }
    public function addCart(Request $request,$id)
    {
        $product = Product::find($id);
        if($request->qty){
            $qty =$request->qty;
        }
        else {
            $qty =1;
        }
        if($product->promotional>0)
        {
            $price = $product->promotional;
        }else
        {
            $price = $product->price;
        }
        $cart = [
            'id' => $id,
            'name' => $product->name,
            'qty' => $qty ,
            'price' => $product->price,
            'options' => [
                'img' => $product->image,
                ]
        ];
        Cart::add($cart);
        return back()->with('success', 'Đã mua '.$product->name.' thành công!');
    }
}
