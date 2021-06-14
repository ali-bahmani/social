<?php

namespace App\Listeners;

use App\Events\NewFollower;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewFollower as NewFollowerNotification;
use App\Models\User;


class SendNewFollowNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $follower;

    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  NewFollower  $event
     * @return void
     */
    public function handle(NewFollower $event)
    {
        $this->follower = $event->follower;
        $user = User::find($this->follower['user_id']);
        $user->notify(new NewFollowerNotification($this->follower));
    }
}
