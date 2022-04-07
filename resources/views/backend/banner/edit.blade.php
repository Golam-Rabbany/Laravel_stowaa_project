
@section('title', 'Edit Banner - ')
@extends('layouts.backend_main')

@section('content')
@can('edit')

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="title_left">
            <h3>Banner Form</h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Banner <a href="{{ route('backend.banner.index') }}"><button class="btn btn-primary ml-5">All Banner</button></a></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div> 
            <div class="x_content">
                <br>
                <form method="POST" action="{{ route('backend.banner.update',$banner->id) }}" enctype="multipart/form-data"  >
                    @csrf
                    @method('PUT')

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Banner Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" name="title" class="form-control" class="form-control " value="{{$banner->title}}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Banner Description</label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea name="description" class="form-control" id="description" rows="4"> {{$banner->description}} </textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="banner_photo" class="col-form-label col-md-3 col-sm-3 label-align">Banner Image</label>
                        <div class="col-md-6 col-sm-6 ">
                            <input class="form-control" type="file" id="upload_image" name="banner_photo">
                            <img width="100" height="100" id="insert_image" src="{{ asset('storage/uploads/banner/'.$banner->banner_photo) }}" alt="{{$banner->title}}">
                            @error('banner_photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
    
@endcan
@endsection
