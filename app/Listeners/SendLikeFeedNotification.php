<?php

namespace App\Listeners;

use App\Events\LikeFeed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\LikeFeed as LikeFeedNotification;
use App\Models\User;

class SendLikeFeedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $username;
    public $user;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LikeFeed  $event
     * @return void
     */
    public function handle(LikeFeed $event)
    {
        $this->user = User::find($event->userFeed);
        $this->username = $event->userLike;

        $this->user->notify(new LikeFeedNotification($this->username));
 
    
    }
}
