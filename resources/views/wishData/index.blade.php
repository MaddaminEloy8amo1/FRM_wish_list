@extends('wishData.layout')

@section('content')
    <div class="my-5 row text-center">
        <div class="col-4">
            @if (isset($userWishData))
                <a class="btn btn-primary" href="/admin"> Back</a>
            @else
                <a class="btn btn-primary" href="/"> Back</a>
            @endif
        </div>
        <div class="col-4 text-center">
            @if (isset($userWishData))
                <h2>{{ $userName->name }}'s Xmas Wishlist</h2>
            @else
                <h2>{{ Auth::user()->name }}'s Xmas Wishlist</h2>
            @endif
        </div>
        @if (!isset($userWishData))
            <div class="col-4">
                <a class="btn btn-success" href="{{ route('wishData.create') }}"> Create New Wish</a>
            </div>
        @endif
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
        @if (isset($userWishData))
            @foreach ($userWishData as $uwData)
                <div class="col-2">
                    <img class="w-100" src="{{ URL::to('/') }}/images/{{ $uwData->img }}">
                </div>
                <div class="col-6">
                    <h5>{{ $uwData->name }}</h5>
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

        @else
            @foreach ($wishData as $wData)
                <div class="col-2">
                    <img class="w-100" src="{{ URL::to('/') }}/images/{{ $wData->img }}">
                </div>
                <div class="col-6">
                    <h5>{{ $wData->name }}</h5>
                    <p>{{ $wData->description }}</p>
                </div>
                <div class="col-2">
                    <div class="ippa">
                        <a class="text-decoration-none font-weight-bold" target="_blank"
                           href="{{ $wData->link }}"><h5>€ {{ $wData->price }}<br>Buy this</h5></a>
                    </div>
                    <div class="mt-5">
                        <form action="{{ route('wishData.destroy',$wData->id) }}" method="POST">


                            <a class="btn btn-primary" href="{{ route('wishData.edit',$wData->id) }}">Edit</a>
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


            {!! $wishData->links() !!}

        @endif

    </div>

@endsection
