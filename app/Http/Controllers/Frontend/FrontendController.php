<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendController extends Controller
{
    //
    public function index(){
        return view('frontend.frontend');
    }

    public function shop(){

        $products = Product::with('sizes','colors','categories')->orderBy("created_at", 'DESC')->select('id','title','short_descrip','price','sale_price','quantity','photo','status')->paginate(10);
        return view('frontend.shop',compact('products'));
    }
}
