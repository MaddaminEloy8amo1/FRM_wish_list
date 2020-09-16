@extends('wishData.layout')

@section('content')
    <div class="my-5 row text-center">
        <div class="col-4">
            <a class="btn btn-primary" href="/"> Back</a>
        </div>
        <div class="col-4 text-center">
            <h2>Xmas Wishlist</h2>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="{{ route('wishData.create') }}"> Create New Wish</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="row justify-content-center w-75 m-auto">
        @foreach ($wishData as $wData)
            <div class="col-2">
                <img class="w-100" src="{{ $wData->img }}">
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

                        <a class="btn btn-info" href="{{ route('wishData.show',$wData->id) }}">Show</a>


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

    </div>

@endsection
