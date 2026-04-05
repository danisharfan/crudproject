@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Product List</h2>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('products.index')}}" class="float-end btn btn-warning">View All
                                Products</a>
                        </div>
                        <div class="col-md-12" style="padding-top:20px;">
                            <form class="d-flex" role="search" action="{{ route('products.trashed')}}" method="GET">
                                @csrf
                                <input class="form-control me-2" name="search" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>
        @if (Session::has('success'))
        <span class="alert alert-success p-2">{{ Session::get('success')}}</span>
        @endif
        @if (Session::has('error'))
        <span>{{ Session::get('error')}}</span>
        @endif
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><img src="{{ asset('storage/' . $product->image) }}" width="100"></td>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->quantity}}</td>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->status}}</td>
                        <td>{{ $product->description}}</td>
                        <td>
                            <a href="{{ route('trashed.show', $product->id) }}" class="btn btn-success btn">show</a>
                            <form action="{{ route('trashed.restore', $product->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('PUT')
                                <button onclick="return confirm('Are you sure?')"
                                    class="btn btn btn-info">Restore</button>
                            </form>
                            <form action="{{ route('trashed.delete', $product->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')"
                                    class="btn btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" class="text-center">No Data Found!</td>
                    </tr>
                    @endif
 
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection