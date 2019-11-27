<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Reply;
use Illuminate\Support\Facades\Notification;

class DiscussionsController extends Controller
{
    public function create()
    {
        return view('discuss');
    }

    /**
     * @param Request $r
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $r)
    {

        $this->validate($r,[
            'channel_id'=>'required',
            'content'=>'required',
            'title'=>'required'
        ]);

        $discussion = new Discussion();


            $discussion->title = $r->title;
            $discussion->content = $r['content'];
            $discussion->channel_id=$r->channel_id;
            $discussion->user_id = Auth::id();
            $discussion->slug = str_slug($r->title);
            $discussion->save();



        Session::flash('success','Discussion successfully created');
//        dd(Session::get('success'));

        return redirect()->route('discussion',['slug'=>$discussion->slug]);
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug',$slug)->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussions.show')
            ->with('d',$discussion)
            ->with('best_answer', $best_answer);
    }

    public function reply($id)
    {
        $d=Discussion::find($id);


        $reply=Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply
        ]);

        $reply->user->points += 30;
        $reply->user->save();


        $watchers =array();

        foreach ($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));

        endforeach;

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));


        Session::flash('success','Replied to discussion.');

        return redirect()->back();
    }
}
