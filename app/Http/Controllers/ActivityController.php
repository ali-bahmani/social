<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        return view('Activity.index');
    }

    public function notifications(){
        $user = auth()->user();
        $notifications = $user->unreadNotifications;

        return view('Activity.notification',compact('notifications'));
    }
}
