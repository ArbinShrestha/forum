@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit channel:{{$channel->title}}</div>

        <div class="card-body">

            <form action="{{route('channels.update', ['channel'=>$channel->id])}}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <input type="text" name="channel" value="{{$channel->title}}" class="form-control" >
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update channel
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>


@endsection
