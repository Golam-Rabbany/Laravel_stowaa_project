@section('title', 'View Banner - ')
@extends('layouts.backend_main')


@section('content')
@can('add')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="title_left">
                <h3>View Banner</h3>
            </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Recycle Bin<a href="{{route('backend.banner.index') }}"><button class="btn btn-primary ml-5">All Banner</button></a></h2>
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
                        @foreach ($trashedData as $data)
                            <tr>
                                <th>{{$data->id}}</th>
                                <td>{{$data->title}}</td>
                                <td><img width="70" height="70" src="{{ asset('storage/uploads/banner/'.$data->banner_photo) }}" alt="{{$data->title}}"></td>
                                <td>{{Str::limit($data->description, 10, '...') }}</td>
                                <td>{{ $data-> status == 1 ? "Active" : "Deactive"}}</td>
                                <td>
                                    <a href="{{route('backend.banner.restore',$data->id)}}" type="submit" class="btn btn-primary btn-sm">Restore</a>
                                    <button type="submit" value="{{route('backend.parmanent.delete',$data->id)}}" class="parmenent_delete btn btn-danger btn-sm">Parmanent Delete</butto>
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

@section('banner_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.6/sweetalert2.min.css" />
@endsection

@section('banner_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.6/sweetalert2.all.js"></script>
<script>
    $('.toast').toast('show')
        $('.parmenent_delete').on('click', function(){
           let $btnUrl = $(this).val();

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $btnUrl; 
            }
            })


        })
       
</script>
@endsection



