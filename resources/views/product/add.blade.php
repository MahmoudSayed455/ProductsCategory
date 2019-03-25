@extends("layouts.app")
@section('content')
    <div class="container">
        <h1 class="text-center display-4 mt-5 create-h1"> Add New Product </h1>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 col-11 mb-5 py-5" style="box-shadow: 4px 4px 20px #eee">
                <span class="custom-fontawseome text-success"><i class="fas fa-dollar-sign mr-2"></i></span>
                <form action="/products" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{csrf_field()}}
                    <label> Select Category:</label>
                    <select name="categoryname" class="form-control" required>
                        @foreach($categories as $category)
                        <option>{{$category->category_name}}</option>
                            @endforeach
                    </select><br>
                    <label>Enter Product Name:</label>
                    <input name="product_name" type="text" class="form-control" required><br>
                    <input type="file" name="images[]" multiple><br>
                    <button type="submit" class="btn btn-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection