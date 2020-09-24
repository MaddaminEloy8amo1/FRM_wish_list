@extends('wishData.layout')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-4">
                <a class="btn btn-primary" href="{{ route('wishData.index') }}"> Back</a>
            </div>
            <div class="col-4 text-center">
                <h2>Add New Wish</h2>
            </div>
        </div>

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <form action="{{ route('wishData.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="img" class="form-control" placeholder="">
                        <span class="text-danger">{{ $errors->first('img') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Description">
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="number" class="form-control" name="price" placeholder="Price">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product link:</strong>
                        <input type="text" class="form-control" name="link" placeholder="Product link">
                        <span class="text-danger">{{ $errors->first('link') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endsection
