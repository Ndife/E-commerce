@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">Products</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        @foreach ($products as $product)
                            <tbody>
                                <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-sm mr-2">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('products.destroy', $product->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="sumbit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
