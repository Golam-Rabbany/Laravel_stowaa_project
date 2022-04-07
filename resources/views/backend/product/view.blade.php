@section('title', 'View Product - ')
@extends('layouts.backend_main')


@section('content')
@can('all')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="title_left">
                <h3>View Product</h3>
            </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>All Product</h2>
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
                            <th>Category</th>
                            <th>Size</th>
                            <th>Colors</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <td>
                                    @foreach ($product->categories as $category)
                                        <span class="badge badge-primary">{{$category->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->sizes as $size )
                                        <span class="badge badge-success">{{$size->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->colors as $color )
                                        <span class="badge badge-warning">{{$color->name}}</span>
                                    @endforeach
                                </td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td><img width="50" src="{{ asset('storage/uploads/products/'.$product->photo) }}" alt=""></td>
                                <td>{{$product->status}}</td>
                                <td style="display: flex">
                                    <a href="{{route('backend.product.edit',$product->id)}}"><button type="submit" class="btn btn-warning btn-sm">Edit</button></a>
                                    <form action="{{route('backend.product.destroy', $product->id)}}" method="POST">
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

