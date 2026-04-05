@extends('layouts.layout')
@section('content')
    <div class="container-fluid py-4" style="min-height: 100vh; background: #f5f6fa;">
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
                                <div class="row">
                                    <div class="col">
                                        <div><a href="{{ route('products.trashed') }}" class="float-end btn btn-danger"
                                                style="margin-left:10px;">Deleted</a></div>
                                        <div><a href="{{ route('products.create') }}" class="float-end btn btn-light">Add
                                                New</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center" style="padding-top:20px;">
                                <form class="d-flex w-75" role="search" action="{{ route('products.index') }}"
                                    method="GET">
                                    @csrf
                                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                                        aria-label="Search">

                                    <button class="btn btn-light px-4" type="submit">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <span class="alert alert-success p-2">{{ Session::get('success') }}</span>
            @endif
            @if (Session::has('error'))
                <span>{{ Session::get('error') }}</span>
            @endif
            <div class="card-body">
                <table class="table table-hover align-middle" style="border-radius: 10px; overflow: hidden;">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" width="70"
                                            class="rounded shadow-sm border">
                                    </td>

                                    <td class="fw-semibold">{{ str($product->name)->words(2) }}</td>

                                    <td>{{ $product->quantity }}</td>

                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                                    <td>
                                        <span
                                            class="badge 
                            {{ $product->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                    <td>{{ str($product->description)->words(5) }}</td>

                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-sm btn-success mb-1">Show</a>

                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-primary mb-1">Edit</a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No Data Found!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
        </div>
    </div>
@endsection