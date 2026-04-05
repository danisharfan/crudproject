@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Add New Product
        </div>
        <div class="card-body">
            <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('product.form')
 
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('products.index')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
 
</div>
 
@endsection