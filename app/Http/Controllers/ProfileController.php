<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $feeds = Feed::where('user_id',auth()->id())->orderBy('created_at','desc')->get();
        $user = auth()->user();
        $followersCount = $user->followers->count();
        $followingsCount = $user->followings->count();
        $feedCount = $feeds->count();

        return view('Profile.index',compact('feeds','user','followersCount','followingsCount','feedCount'));
    }

    public function editAvatar(){

    }

    public function editProfile(){

    }

    public function userProfile(User $user){

        if($user->id == auth()->id()){
            return redirect()->route('profile.index');
        }

        $isFollower = $user->followers->pluck('follower_id')->contains(auth()->id());
        $followersCount = $user->followers->count();
        $followingsCount = $user->followings->count();
        $feeds = $user->feeds;
        $feedCount = $feeds->count();
        $userProfile = true;

        if($isFollower){
            return view('Profile.index',compact('feeds','user','userProfile','isFollower','followersCount','followingsCount','feedCount'));
        }else{
            return view('Profile.index',compact('feeds','user','userProfile','followersCount','followingsCount','feedCount'));
        }
        
    }

    public function update(){
        $user = auth()->user();
        return view('Profile.edit',compact('user'));

    }

    public function edit(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email',
            'file'=>'nullable|mimes:jpg,jpeg,png|max:100000',
        ]);
        $user = auth()->user();
        if($request->file('file')){
            $path = Storage::url($request->file('file')->store('avatars'));
        }else{
            $path = $user->avatar_path;
        }
        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'avatar_path' => $path
        ]);
        return back();
    }
}
