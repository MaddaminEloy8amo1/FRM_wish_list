@extends('wishData.layout')

@section('content')
    <div class="my-5 row text-center">
        <div class="col-4">
            <a class="btn btn-primary" href="{{ route('wishData.index') }}"> Back</a>
        </div>
        <div class="col-4 text-center">
            <h2>Admin panel</h2>
        </div>
    </div>

    <div class="row w-75 m-auto justify-content-center">
        @foreach ($users as $user)
            <div class="card col-3 m-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                    <a href="{{ route('wishData.show',$user->id) }}" class="card-link">Edit users Wishlist</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
