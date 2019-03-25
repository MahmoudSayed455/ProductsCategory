@extends("layouts.app")
@section('content')
    <h1 class="text-center text-monospace text-info">All Products</h1>
    <table class="table table-bordered mt-5 table-hover text-center table-dark">
        <th>Product Name</th>
        <th>Product Images</th>
        <th>Category Id</th>
        <th>Actions</th>
        @foreach($products as $product)
            <tr>
                <td class="mt-3">{{$product->product_name}}</td>
                <td class="mt-3">{{$product->multiple_images}}</td>
                <td class=" mt-3">{{$product->category_id}}</td>
                <td>
                    <a href="/deleteproduct/{{$product->id}}" class="btn btn-danger  mt-3">Delete</a>
                    <a href="/editproduct/{{$product->id}}" class="btn btn-info  mt-3">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection