@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                <div class="card-body">
                    @include('partials.errors')
                    <form action="{{isset($product) ? route('products.update', $product->id) : route('products.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" id="name" class="form-control" value="{{ isset($product) ? $product->name : old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input name="price" id="price" class="form-control" value="{{ isset($product) ? $product->price : old('price')}}">
                        </div>

                        @if (isset($product))
                            <div class="form-group">
                            <img src="{{ asset($product->image)}}" alt="{{$product->image}}" width="300" height="200"/>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="form-control" name="image" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ isset($product) ? $product->description : old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">{{isset($product) ? 'Update Product': 'Save Product' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
