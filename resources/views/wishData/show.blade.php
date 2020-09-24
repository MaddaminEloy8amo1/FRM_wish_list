@extends('wishData.layout')

@section('content')
    <div class="my-5 row text-center">
        <div class="col-4">
            <a class="btn btn-primary" href="/admin"> Back</a>
        </div>
        <div class="col-4 text-center">
            <h2>{{ $userName->name }}'s Xmas Wishlist</h2>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="{{ route('wishData.create') }}"> Create New Wish</a>
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
    <div class="row justify-content-center w-75 m-auto">
        @foreach ($userWishData as $uwData)
            <div class="col-2">
                <img class="w-100" src="{{ $uwData->img }}">
            </div>
            <div class="col-6">
                <h5>{{ $uwData->name }}</h5>
                <h5>{{  $uwData->user_id }}</h5>
                <p>{{ $uwData->description }}</p>
            </div>
            <div class="col-2">
                <div class="ippa">
                    <a class="text-decoration-none font-weight-bold" target="_blank"
                       href="{{ $uwData->link }}"><h5>€ {{ $uwData->price }}<br>Buy this</h5></a>
                </div>
                <div class="mt-5">
                    <form action="{{ route('wishData.destroy',$uwData->id) }}" method="POST">


                        <a class="btn btn-primary" href="{{ route('wishData.edit',$uwData->id) }}">Edit</a>
                        <!-- SUPPORT ABOVE VERSION 5.5 -->
                        {{-- @csrf
                        @method('DELETE') --}}

                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}


                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="col-12 my-4">
                <hr class="w-75">
            </div>
        @endforeach


        {!! $userWishData->links() !!}

    </div>

@endsection
