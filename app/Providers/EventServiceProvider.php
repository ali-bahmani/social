<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewFollower;
use App\Events\LikeFeed;
use App\Events\NewComment;

use App\Listeners\SendNewFollowNotification;
use App\Listeners\SendLikeFeedNotification;
use App\Listeners\SendNewCommentNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NewFollower::class => [
            SendNewFollowNotification::class,
        ],

        LikeFeed::class => [
            SendLikeFeedNotification::class,
        ],

        NewComment::class => [
            SendNewCommentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
