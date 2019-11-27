@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">
            <span>{{$d->user->name}},<b>({{$d->user->points}})</b></span>
            @if($d->is_being_watched_by_auth_user())
                <a href="{{route('discussion.unwatch',['id'=>$d->id])}}" type="button" class="btn btn-default btn-sm float-right">unwatch</a>
            @else
                <a href="{{route('discussion.watch',['id'=>$d->id])}}" type="button" class="btn btn-default btn-sm float-right">watch</a>
            @endif
        </div>

        <div class="card-body">
            <h4 class="text-center">
                <b>{{$d->title}}</b>
            </h4>
            <hr>
            <p class="text-center">
                {{$d->content}}

            </p>

            <hr>
            @if($best_answer)
                <div class="text-center" style="padding: 40px">
                    <h3 class="text-center">Best Answer</h3>
                    <div class="card card-success">
                        <div class="card-header">
                            <img src="{{$best_answer->user->avatar}}" alt="" width="40px" height="40px">
                            <span>{{$best_answer->user->name}}<b>({{$best_answer->user->points}})</b></span>
                        </div>

                        <div class="card-body">
                            {{$best_answer->content}}
                        </div>
                    </div>
                </div>
                @endif

        </div>

        <div class="card-footer">
                <span>
                    {{$d->replies->count()}}Replies
                </span>
            <a href="{{route('channel',['slug'=>$d->channel->slug])}}" class="float-right btn btn-outline-primary btn-sm">{{$d->channel->title}}</a>
        </div>
    </div>

    @foreach($d->replies as $r)
         <div class="card">
            <div class="card-header">
                <img src="{{$r->user->avatar}}" alt="" width="40px" height="40px">
                <span>{{$r->user->name}},<b>({{$r->user->points}})</b></span>
                @if(!$best_answer)
                    @if(Auth::id() == $d->user->id)
                        <a href="{{route('discussion.best.answer', ['id' => $r->id])}}" class="btn btn-sm btn-info float-right">Mark as best answer</a>
                    @endif
                @endif

            </div>

            <div class="card-body">
                <p class="text-center">
                    {{$r->content}}
                </p>
            </div>

            <div class="card-footer">
                @if($r->is_liked_by_auth_user())
                    <a href="{{route('reply.unlike',['id'=>$r->id])}}" class="btn btn-danger btn-sm">Unlike <span class="badge">{{$r->likes->count()}}</span></a>
                @else
                    <a href="{{route('reply.like',['id'=>$r->id])}}" class="btn btn-success btn-sm">Like <span class="badge">{{$r->likes->count()}}</span> </a>
                @endif

            </div>


        </div>
    @endforeach

    <div class="card">
        <div class="card-body">
            @if(Auth::check())
                <form action="{{route('discussion.reply',['id'=>$d->id])}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn float-right">Leave a reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h2>Sign in to leave a reply</h2>
                </div>

            @endif
        </div>
    </div>

@endsection
