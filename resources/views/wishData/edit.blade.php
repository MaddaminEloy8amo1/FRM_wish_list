@extends('wishData.layout')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-4">
                <a class="btn btn-primary" href="{{ route('wishData.index') }}"> Back</a>
            </div>
            <div class="col-4 text-center">
                <h2>Edit Wish</h2>
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

        <form action="{{ route('wishData.update',$wishData->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="img" value="{{ $wishData->image }}" />
                        <img src="{{ URL::to('/') }}/images/{{ $wishData->img }}" class="img-thumbnail" width="200" />
                        <input type="hidden" name="hidden_image" value="{{ $wishData->img }}" />
                        <span class="text-danger">{{ $errors->first('img') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $wishData->name }}" class="form-control"
                               placeholder="Name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" value="{{ $wishData->description }}" class="form-control"
                               placeholder="Description">
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="number" class="form-control" name="price" value="{{ $wishData->price }}"
                               placeholder="Price">
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product link:</strong>
                        <input type="text" class="form-control" name="link" value="{{ $wishData->link }}"
                               placeholder="Product link">
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
