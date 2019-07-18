<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Product;

use Auth;
use Cart;


class HomeController extends Controller
{
    public function index(){
        $product1 = Product::where('status', 1)->where('category_id',8)->get();
        $product2 = Product::where('status',1)->where('category_id',18)->get();
        $viewData = ([
            'prosamsung' => $product1,
            'pronetwork' => $product2
        ]);
        return view('client.pages.index',$viewData);
    }

    public function __construct(){
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status', 1)->get();
        $viewData = [
            'category' => $category,
            'producttype' => $producttype
        ];
        view()->share($viewData);
        if(Auth::check()){
            $user = Auth::user();
            view()->share('user', $user);
        }
    }
}

