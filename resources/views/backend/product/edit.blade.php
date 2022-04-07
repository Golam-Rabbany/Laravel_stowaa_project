
@section('title', 'Create Product - ')
@extends('layouts.backend_main')

@section('content')
@can('edit')
<div class="row">
    <div class="col-md-12">
        <div class="title_left">
            <h3>Product</h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Product</h2>
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
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @foreach ($products as $product)
                    <div class="col-md-12 form-group">
                        <label for="title">Product Title</label>
                        <div>
                            <input type="text" name="title" class="form-control" value="{{$product->title}}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="photo">Product Photo</label>
                        <div>
                            <input type="file" name="photo" class="form-control">
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="gallery">Photo Gallery</label>
                        <div>
                            <input type="file" name="gallery[]" id="gallery" class="form-control" multiple>
                            @error('gallery')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="price">Price</label>
                        <div>
                            <input type="number" name="price" class="form-control" value="{{$product->price}}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="sale_price">Sale Price</label>
                        <div>
                            <input type="number" name="sale_price" class="form-control" value="{{$product->sale_price}}">
                            @error('sale_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="quantity">Quantity</label>
                        <div>
                            <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="size">Product Size</label>
                            <select name="sizes[]" name="size" class="form-control multiselect" multiple="multiple">
                                <option disabled>Select Size</option>
                                
                            @error('size')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="color">Product Color</label>
                            <select name="colors[]" name="color" class="form-control multiselect" multiple="multiple" >
                                <option disabled>Select Color</option>
                                
                            @error('color')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="category">Product Category</label>
                            <select name="categories[]" name="category" class="form-control multiselect" multiple="multiple">
                                <option disabled>Select Category</option>
                                
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="short_descrip">Short Description</label>
                        <div>
                            <textarea name="short_descrip" class="form-control" rows="2">{{$product->short_descrip}}</textarea>
                            @error('short_descrip')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="description">Long Description</label>
                        <div>
                            <textarea name="description" class="summernote form-control" rows="3">{{$product->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="add_info">Additional Information</label>
                        <div>
                            <textarea name="add_info" class="summernote form-control" rows="2">{{$product->add_info}}</textarea>
                            @error('add_info')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                        
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endcan



@if (session('success'))
    <div class="toast" style="position: absolute; top: 0; right: 0;" data-delay="6000">
        <div class="toast-header">
            <strong class="mr-auto">{{ config('app.name') }}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
@endif

@endsection

@section('banner_js')
<script>
    $('.toast').toast('show')
</script>
@endsection



@section('backend_css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endsection

@section('backend_js')
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
        $(document).ready(function() {
            $('.multiselect').select2();
            $('.summernote').summernote({
                height: 100,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ]
            });
        });

</script>
<script>
    
</script>
@endsection