@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
        <div class="card">
            <div class="card-header">
                <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">
                <span>{{$d->user->name}},<b>{{$d->created_at->diffForHumans()}}</b></span>
                <a href="{{route('discussion',['slug'=>$d->slug])}}" type="button" class="btn btn-default float-right">view</a>
            </div>

            <div class="card-body">
                <h4 class="text-center">
                   <b>{{$d->title}}</b>
                </h4>
                <hr>
                <p class="text-center">
                    {{str_limit($d->content, 50)}}
                </p>
            </div>

            <div class="card-footer">
                <span>
                    {{$d->replies->count()}}Replies
                </span>
                <a href="{{route('channel',['slug'=>$d->channel->slug])}}" class="float-right btn btn-outline-primary btn-sm">{{$d->channel->title}}</a>
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{$discussions->links()}}
    </div>
@endsection
