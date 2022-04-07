
@section('title', 'Category - ')
@extends('layouts.backend_main')

@section('content')
<div class="row">
    @can('add')
    <div class="col-md-5">
        <div class="title_left">
            <h3>Product Category</h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Category</h2>
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
                <form method="POST" action="{{ route('backend.category.store') }}" enctype="multipart/form-data"  >
                    @csrf

                    <div class="form-group">
                        <label for="name">Product Category<span class="required">*</span></label>
                        <div>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="parent">Select Parent</label>
                        <div>
                            <select name="parent" class="form-control" id="">
                                <option disabled selected>Select Parent Category</option>
                                @foreach ($datas as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            @error('parent')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <div>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <div>
                            <input type="file" name="photo" class="form-control">
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary form-control mt-3">Submit</button>


                </form>
            </div>
        </div>
    </div>
    @endcan

    @can('all')
    <div class="col-md-7 col-sm-7 ">
        <div class="title_left">
            <h3>View Category</h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>All Banner</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Category Photo</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <th>{{$data->id}}</th>
                                <td>{{$data->name}}</td>
                                <td>{{$data->slug}}</td>
                                <td><img height="50" width="50" src="{{ asset('storage/uploads/category/'.$data->photo) }}" alt="{{$data->name}}"></td>
                                <td>{{Str::limit($data->description, 10, '...') }}</td>                            
                            </tr>
                            @if (!empty($data->childs))
                                @foreach ($data->childs as $child)
                                <tr>
                                    <th></th>
                                    <td>___{{$child->name}}</td>
                                    <td>{{$child->slug}}</td>
                                    <td><img height="50" width="50" src="{{ asset('storage/uploads/category/'.$child->photo) }}" alt="{{$child->name}}"></td>
                                    <td>{{Str::limit($child->description, 10, '...') }}</td>                            
                                </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>  
    @endcan
</div>
@endsection

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


@section('banner_js')
<script>
    $('.toast').toast('show')
</script>
@endsection