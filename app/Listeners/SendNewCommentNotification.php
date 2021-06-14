<?php

namespace App\Listeners;

use App\Events\NewComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Feed;
use App\Notifications\NewComment as NewCommentNotification;

class SendNewCommentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $comment;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewComment  $event
     * @return void
     */
    public function handle(NewComment $event)
    {
        $this->comment = $event->comment;
        $user = Feed::find($this->comment->feed_id)->user;
        $user->notify(new NewCommentNotification($this->comment));
    }
}
