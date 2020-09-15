@extends('wishData.layout')

@section('content')
    <div class="container">
        <div class="row my-5 d-block">
            <div class="text-center">
                <h2>Welcome Xmas Wishlist website</h2>
            </div>
            <div class="text-center my-3">
                <a class="btn btn-primary" href="{{ route('wishData.index') }}"> Go to Xmas Wishlist</a>
            </div>
        </div>
    </div>

@endsection
