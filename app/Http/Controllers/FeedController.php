<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Events\LikeFeed;

class FeedController extends Controller
{
    public function show(Feed $feed){
        views($feed)->record();
        $profile = auth()->id() == $feed->user_id ? $from='profile' : $from='explorer';
        $comments = Comment::all()->where('feed_id',$feed->id);
        $commentCount = $comments->count();

        return view('Feeds.show',compact('feed','comments','commentCount','from'));
    }

    public function create(){
        return view('Feeds.create');
    }

    public function store(Request $request){
        $request->validate([
            'file'=>'required|mimes:jpg,jpeg,png,mkv,mp4|max:100000',
        ]);

        $path = $request->file('file')->store('feeds');
        $feed = new Feed;
        $feed->path = Storage::url($path);
        $feed->description = $request->description;
        $feed->type = strtok($request->file('file')->getClientMimeType(), '/');
        $feed->user_id = auth()->id();
        $feed->save();
        if($feed->save()){
            return back();
        }else{
            return 'error';
        }
    }

    public function likeCount(Feed $feed){
        $reactantFacade = $feed->viaLoveReactant();
        $reactionCounters = $reactantFacade->getReactionCounters()[0]['count'] ?? 0;
        $name = 'ali';
        

        $user = auth()->user();
        $reacterFacade = $user->viaLoveReacter();
        $isLiked = $reacterFacade->hasReactedTo($feed);
        
        return compact('reactionCounters','isLiked');

    }

    public function like(Feed $feed){
        $userLike = auth()->user();

        $reacterFacade = $userLike->viaLoveReacter();
        $userFeed = $feed->user->id;

        if($reacterFacade->hasReactedTo($feed)){
            $reacterFacade->unreactTo($feed, 'Like');
        }else{
            $reacterFacade->reactTo($feed, 'Like');
            event(new LikeFeed($userLike->name,$userFeed));
        }

        return 'ok';

    }

    public function delete(Feed $feed){
        $feed->delete();
        return response('feed deleted', 200);
    }

    public function update(){
        return 'update';
    }
}
