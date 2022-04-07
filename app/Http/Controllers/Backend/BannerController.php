<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Banner::all();
        return view('backend.banner.all',compact('datas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.banner.add');
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
            'title' => 'required',
            'description' => 'max:250',
            'banner_photo' => 'required|mimes:jpg,png,jpeg,webp|max:1024',
        ]);

        $banner_image = $request->file('banner_photo');
        $banner_name = Str::slug($request->title).'_'.time().'.'.$banner_image->getClientOriginalExtension();
        $banner_upload = $banner_image->move(public_path('storage/uploads/banner/'),$banner_name);

        if($banner_upload){
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->banner_photo = $banner_name;
            $banner->save();
            return redirect(route('backend.banner.index'))->with('success', 'Banner created Successfully');
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('backend.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'title'=>'required',
            'description'=>'max:250',
            'banner_photo'=> 'image|mimes:jpg,png,webp|max:1024',

        ]);

        $banner_img = $request->file('banner_photo');

        if(!empty($banner_img)){
            $photo_name = Str::slug($request->title)."-".time().".".$banner_img->getClientOriginalExtension();
            $banner_upload = $banner_img->move(public_path('storage/uploads/banner/'),$photo_name);

            $exit_file = public_path('storage/uploads/banner/'.$banner->banner_photo);
            if(file_exists($exit_file)){
                unlink($exit_file);
            }
        }else{
            $photo_name = $banner->banner_photo;
        }

        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->banner_photo = $photo_name;
        $banner->save();
        return back()->with('success', 'banner update successfully done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        if($banner->status == 1){
            $banner->status = 2;
            $banner->save();
        }else{
            $banner->status = 2;
            $banner->save();
        }
        return back()->with('success', 'Banner Content Deleted Successfully');
    }

    public function activeStatus(Banner $banner){
        if($banner->status == 1){
            $banner->status = 2;
            $banner->save();
            return back()->with('success', 'banner status updated');
        }else{
            $banner->status = 1;
            $banner->save();
            return back()->with('success', 'banner status updated');

        }
    }

    public function trash(){
        $datas =Banner::all();
        $trashedData = Banner::onlyTrashed()->get();
        return view('backend.destroy.banner_trash',compact('datas','trashedData'));
    }

    public function bannerRestore($id){
        $restoreData = Banner::onlyTrashed()->find($id);
        $restoreData->restore();
        if($restoreData->status == 1){
            $restoreData->status = 1;
            $restoreData->save();
        }else{
            $restoreData->status = 1;
            $restoreData->save();
        }
        return back()->with('success', 'Banner Data Restore Successfully');
    } 

    public function parmenentDelete($id){
        $data = Banner::onlyTrashed()->find($id);
        $data->forceDelete();
        $exFile = public_path('storage/uploads/banner/'.$data->banner_photo);
        if(file_exists($exFile)){
            unlink($exFile);
            
        }
        return back()->with('success', 'Banner data parmanently deleted');
    }


}
