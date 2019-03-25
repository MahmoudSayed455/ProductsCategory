@extends("layouts.app")
@section('content')
    <div class="container">
        <h1 class="text-center display-4 mt-5 create-h1"> Add New Category </h1>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 col-11 mb-5 py-5" style="box-shadow: 4px 4px 20px #eee">
                <span class="custom-fontawseome text-success"><i class="fas fa-dollar-sign mr-2"></i></span>
                <form action="/categories" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label> Enter Category Name:</label>
                    <input type="text" name="categoryname" class="form-control" required>
                    <button type="submit" class="btn btn-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection