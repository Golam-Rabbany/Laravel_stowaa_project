
@section('title', 'Product Color - ')
@extends('layouts.backend_main')

@section('content')
@can('edit')
<div class="row">
    <div class="col-md-5">
        <div class="title_left">
            <h3>Product Color</h3>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Color</h2>
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
                <form method="POST" action="{{route('backend.color.store')}}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Product Color<span class="required">*</span></label>
                        <div>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary form-control mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="x_panel">
            <div class="x_title">
                <h2>Color</h2>
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
                            <th>Color</th>
                            <th>Slug</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr>
                                <th>{{$color->id}}</th>
                                <td>{{$color->name}}</td>
                                <td>{{Str::slug($color->name)}}</td>
                                <td>{{ $color-> status == 1 ? "Active" : "Deactive"}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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