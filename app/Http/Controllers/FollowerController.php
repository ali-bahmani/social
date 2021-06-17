<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\Following;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Events\NewFollower;

class FollowerController extends Controller
{
    public function follow(Request $request){
        $follower = Follower::create([
            'user_id' => $request->user_id,
            'follower_id' => auth()->id()
        ]);

        $following = Following::create([
            'user_id' => auth()->id(),
            'following_id' => $request->user_id
        ]);

        event(new NewFollower($follower));
        return response('user followed',200);
    }

    public function unFollow(Request $request){

        $follower = Follower::where('user_id',$request->user_id)->where('follower_id' , auth()->id())->delete();

        $following = Following::where('user_id',auth()->id())->where('following_id' , $request->user_id)->delete();

        return response('user unfollowed',200);
    }

    public function followers(User $user){
        $followers = [];
        $followers_id = $user->followers->pluck('follower_id');

        foreach ($followers_id as $follower_id) {
            $followers[] = User::find($follower_id);
        }
        return view('Followers.show',compact('followers'));
    }
    
}
