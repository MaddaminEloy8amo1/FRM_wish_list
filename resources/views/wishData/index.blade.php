@extends('wishData.layout')

@section('content')
    <div class="container-fluid">
        <div class="my-5 row text-center">
            <div class="col-4">
                <a class="btn btn-primary" href="/"> Back</a>
            </div>
            <div class="col-4">
                <h2>Xmas Wishlist</h2>
            </div>
            <div class="col-4">
                <a class="btn btn-success" href="{{ route('wishData.create') }}"> Create New Wish</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($wishData as $wData)
            <tr>
                <td><img class="w-75" src="{{ $wData->img }}"></td>
                <td>{{ $wData->name }}</td>
                <td>{{ $wData->description }}</td>
                <td><a target="_blank" href="{{ $wData->link }}">{{ $wData->price }}<br>Buy this</a></td>
                <td>
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
                </td>
            </tr>
        @endforeach
    </table>

    {!! $wishData->links() !!}

@endsection
