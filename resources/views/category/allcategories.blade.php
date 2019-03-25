@extends("layouts.app")
@section('content')
    <h1 class="text-center text-info">All Categories</h1>
    <table class="table table-bordered mt-5 table-hover text-center table-dark">
        <th>Category ID</th>
        <th>Category Name</th>
        @foreach($categories as $category)
            <tr>
                <td class="mt-3">{{$category->id}}</td>
                <td class="mt-3">{{$category->category_name}}</td>
            </tr>
        @endforeach
    </table>
@endsection