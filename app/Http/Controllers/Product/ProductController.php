<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('sizes','colors','categories')->orderBy("created_at", 'DESC')->select('id','title','price','sale_price','quantity','photo','status')->get();
        return view('backend.product.view',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('backend.product.create',compact('sizes','colors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'short_descrip'=>'max:50',
            'price'=>'required|integer',
            'sale_price'=>'integer',
            'quantity'=>'required|integer',
            'description'=>'max:400',
            'add_info'=>'max:400',
            'photo'=>'required:image|mimes:png,jpeg,webp,jpg|max:1024',
        ]);

        $image = $request->file('photo');
        $gallery = $request->file('gallery');

      

        if(!empty($image)){
            $image_name = Str::slug($request->title)."_".time().".".$image->getClientOriginalExtension();
            $upload_image = Image::make($image)->save(public_path('storage/uploads/products/').$image_name);

            if($upload_image){
                $product = new Product();
                $product->user_id = Auth::user()->id;
                $product->title = $request->title;
                $product->slug = Str::slug($request->title);
                $product->short_descrip = $request->short_descrip;
                $product->price = $request->price;
                $product->sale_price = $request->sale_price;
                $product->quantity = $request->quantity;
                $product->description = $request->description;
                $product->add_info = $request->add_info;
                $product->photo = $image_name;
                $product->save();

                $product->categories()->attach($request->categories);
                $product->sizes()->attach($request->sizes);
                $product->colors()->attach($request->colors);
            }

        }

        if($product){
            if(!empty($gallery)){
                foreach($gallery as $gall){
                    $gallery_name = Str::slug($request->title)."_".time().".".$gall->getClientOriginalExtension();
                    $upload_image = Image::make($gall)->save(public_path('storage/uploads/productGallery/').$gallery_name);
                    if($upload_image){
                        $gallery = new ProductGallery();
                        $gallery->product_id = $product->id;
                        $gallery->image = $gallery_name;
                        $gallery->save();
                    }
                }
            }
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = Product::all();
        return view('backend.product.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
