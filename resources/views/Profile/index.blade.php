@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row" id="avatar-div">
        <a>
            <img src="{{$user->avatar_path}}" alt="Avatar" class="profile"> 
        </a>

        
    </div>
    <div class="row" id="bio">
        <p>{{$user->name}}</p>
    </div>
<hr/>
    <div class="container d-flex justify-content-around mb-3" id="information">
        <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{route('follower.showAllFollowers',$user->id)}}" href="javascript:;" >
            <span>Followers</span></br>
            <span>{{$followersCount}}</span>
        </a>

        <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{route('following.showAllFollowings',$user->id)}}" href="javascript:;" >
            <span>Following</span></br>
            <span>{{$followingsCount}}</span>
        </a>

        <a href="">
            <span>Feeds</span></br>
            <span>{{$feedCount}}</span>
        </a>

    </div>
<hr/>

    @isset($userProfile)
        <button type="button" class="btn btn-success btn-lg shadow-lg" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.create')}}" href="javascript:;" >
            <i class="fa fa-plus" aria-hidden="true"></i> Message
        </button>

        @isset($isFollower)
            <button type="button" id="unFollow" class="btn btn-light btn-lg shadow-lg" >
                <i class="fa fa-plus" aria-hidden="true"></i> Unfollow
            </button>
        @else
            <button type="button" id="follow" class="btn btn-info btn-lg shadow-lg" >
                <i class="fa fa-plus" aria-hidden="true"></i> Follow
            </button>
        @endisset

    @else
        <button type="button" class="btn btn-primary btn-lg shadow-lg" data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.create')}}" href="javascript:;" >
            <i class="fa fa-plus" aria-hidden="true"></i> New Feeds!
        </button>
    @endisset
<!-- Modal Create Feed -->


    <div class="row justify-content-center">
    


        @foreach($feeds as $feed)
            <div class="col-4 mt-3" >
                <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.show',$feed->id)}}" href="javascript:;" class="main" >
                    <div class="card">

                    
                        @if($feed->type == 'image')
                        
                            <img src="{{$feed->path}}" class="image-feed">       
                        @elseif($feed->type == 'video')
                            <video class="video-feed">
                                <source src="{{$feed->path}}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                </a>

            </div>
            
        @endforeach
        

        
    </div>
</div>
@endsection

<style>
.profile {
  vertical-align: middle;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  margin: 10px
}

#avatar-div{
    display: flex;
    justify-content: center;
}

.video {
    height: 350px;
}

#bio{
    display: flex;
    justify-content: center;
    font-size: 25px;
}

.avatar {
  vertical-align: middle;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin: 10px
}

.image-feed{
    height: 250px; /* height of container */
    object-fit: cover;
}

.video-feed{
    height: 250px; /* height of container */
    object-fit: cover;
}

.previewImg-div{
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}

.main{
    text-decoration: none;
    color: #111;
}

.main:hover{
    text-decoration: none;
    color: #111;
}

#information{
    text-align: center;
    font-size: 20px;
}
</style>

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
function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

    function likeCount(feedId) {
            Url = '{{route('like.likeCount',':feedId')}}';

            $.ajax({
                type: "get",
                url: Url.replace(':feedId',feedId),
                success: function(response){
                    $('#likeIcon').removeClass("fas fa-heart m-1 fa-lg red-heart")
                    if(response.isLiked == true){
                        $('#likeIcon').addClass("fas fa-heart m-1 fa-lg red-heart");
                        console.log('true')
                    }else{           
                        $('#likeIcon').addClass("far fa-heart m-1 fa-lg ");   
                        console.log('false')
                    }
                    $("#countLike").text(response.reactionCounters);

                },
            })

        }

</script>
@endpush