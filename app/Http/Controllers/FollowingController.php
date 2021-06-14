<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Following;
use App\Models\User;

class FollowingController extends Controller
{
    public function folowings(User $user){
        $followings= [];
        $folowings_id = $user->followings->pluck('following_id');
        foreach ($folowings_id as $folowing_id) {
            $followings[] = User::find($folowing_id);
        }

        return view('Followings.show',compact('followings'));
    }
}
