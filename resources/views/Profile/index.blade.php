@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row profile-image-div">
            <a>
                <img src="{{$user->avatar_path}}" alt="Avatar" class="profile-image"> 
            </a>   
        </div>

        <div class="row" id="bio-user-div">
            <p>{{$user->name}}</p>
        </div>
        @isset($userProfile)

        @else
            <div class="row" id="edit-profile-btn-div">

                <a id="edit-profile-btn" type="button" class="btn btn-secondary shadow-lg" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('profile.update')}}" href="javascript:;">
                    <i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit Profile
                </a>

            </div>
        @endisset
    <hr/>
        <div class="container d-flex justify-content-around mb-3" id="user-information">
            <a id="followers-information" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{route('follower.showAllFollowers',$user->id)}}" href="javascript:;" >
                <span>Followers</span></br>
                <span>{{$followersCount}}</span>
            </a>

            <a id="followeing-information" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{route('following.showAllFollowings',$user->id)}}" href="javascript:;" >
                <span>Following</span></br>
                <span>{{$followingsCount}}</span>
            </a>

            <a id="feed-information" href="">
                <span>Feeds</span></br>
                <span>{{$feedCount}}</span>
            </a>
        </div>
    <hr/>

        @isset($userProfile)
            <button id="message-button" type="button" class="btn btn-success btn-lg shadow-lg" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.create')}}" href="javascript:;" >
                <i class="fa fa-plus" aria-hidden="true"></i> Message
            </button>

            @isset($isFollower)
                <button id="unfollow-button" type="button" id="unFollow" class="btn btn-light btn-lg shadow-lg" >
                    <i class="fa fa-plus" aria-hidden="true"></i> Unfollow
                </button>
            @else
                <button id="follow-button" type="button" id="follow" class="btn btn-info btn-lg shadow-lg" >
                    <i class="fa fa-plus" aria-hidden="true"></i> Follow
                </button>
            @endisset
        @else
            <button id="new-feed-button" type="button" class="btn btn-primary btn-lg shadow-lg" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.create')}}" href="javascript:;" >
                <i class="fa fa-plus" aria-hidden="true"></i> New Feeds!
            </button>
        @endisset

        <div class="row justify-content-center">
            @foreach($feeds as $feed)
                <div class="col-4 mt-3" >
                    <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.show',$feed->id)}}" href="javascript:;" class="feed-body" >
                        <div class="card">
                            @if($feed->type == 'image')
                                <img src="{{$feed->path}}" class="image-feed">       
                            @elseif($feed->type == 'video')
                                <video class="video-feed">
                                    <source src="{{$feed->path}}" type="video/mp4" class="video-feed">
                                </video>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
    </div>
@endsection

@push('scripts')
    <script>
        let follow_url = "{{ route('follower.follow',['user_id'=>$user->id])}}";
        $('#follow').click(function(){
            $.ajax({
                type: "get",
                url: follow_url,
                success: function(){
                    location.reload(true);
                },
            });
        })

        let un_follow_url = "{{ route('follower.unFollow',['user_id'=>$user->id])}}";
        $('#unFollow').click(function(){
            $.ajax({
                type: "get",
                url: un_follow_url,
                success: function(){
                    location.reload(true);
                },
            });
        })

        let edit_profile_url = "{{ route('follower.unFollow',['user_id'=>$user->id])}}";
        $('#unFollow').click(function(){
            $.ajax({
                type: "get",
                url: un_follow_url,
                success: function(){
                    location.reload(true);
                },
            });
        })

    </script>
@endpush
