<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Category::with('childs')->orderby('created_at', 'DESC')->get();
        return view('backend.product.category.category',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "name"=>"required|unique:categories,name",
            "parent"=>"integer",
            "description"=>"max:250",
            "photo"=>"image|mimes:png,jpg,webp|max:1024",
        ]);
        $cat_photo = $request->file('photo');
            if(!empty($cat_photo)){
                $photo_name = Str::slug($request->photo)."-".time().".".$cat_photo->getClientOriginalExtension();
                Image::make($cat_photo)->crop(200,256)->save(public_path('storage/uploads/category/').$photo_name);            
            }

            

            $data = new Category();
            $data->name = $request->name;
            $data->parent = $request->parent;
            $data->slug = Str::slug($request->name);
            $data->description = $request->description;
            $data->photo= $photo_name;
            $data->save();
            return back()->with('success','product category added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
