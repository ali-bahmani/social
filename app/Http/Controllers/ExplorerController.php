<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;

class ExplorerController extends Controller
{
    public function index(){
        $feeds = Feed::inRandomOrder()->get();
        return view('Explorer.index',compact('feeds'));
    }
}
