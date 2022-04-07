@section('title', 'View Banner - ')
@extends('layouts.backend_main')


@section('content')
@can('all')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="title_left">
                <h3>View Banner</h3>
            </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>All Banner <a href="{{route('backend.banner.create') }}"><button class="btn btn-primary ml-5">Add Banner</button></a></h2>
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
                            <th>Title</th>
                            <th>Last Name</th>
                            <th>Banner Photo</th>
                            <th>Active Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <th>{{$data->id}}</th>
                                <td>{{$data->title}}</td>
                                <td><img width="70" height="70" src="{{ asset('storage/uploads/banner/'.$data->banner_photo) }}" alt="{{$data->title}}"></td>
                                <td>{{Str::limit($data->description, 10, '...') }}</td>
                                <td>{{ $data-> status == 1 ? "Active" : "Deactive"}}</td>
                                <td>
                                    <a class="btn btn-{{$data->status == 1 ? "warning" : "info"}} btn-sm" href="{{route('backend.banner.status',$data->id)}}">{{$data->status == 1 ? "Deactive" : "Active"}}</a>
                                </td>
                                <td>
                                    <a href="{{route('backend.banner.edit', $data->id)}}"><button type="submit" class="btn btn-primary btn-sm">Edit</button></a>
                                    <form action="{{route('backend.banner.destroy', $data->id )}}" method="POST" class="d-inline" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
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

