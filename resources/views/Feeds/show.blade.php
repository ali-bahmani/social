@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="close fancybox-button " data-fancybox-close=""  >
                <span aria-hidden="true">&times;</span>
            </button>

            <a href="{{route('profile.userProfile',$feed->user->id)}}" style="margin-bottom: 0px;">
                <img src="{{$feed->user->avatar_path}}" alt="Avatar" class="profile-picture-mini"> 
                <span class="user-name-feed">{{$feed->user->name}}</span>
            </a>
        </div>
    </div>

    <hr style="margin-top: 0px" class="line">

    <div class="row">
        <div class="col-12">
            @if($feed->type == 'image')
                <img src="{{$feed->path}}" class="col-12 image-feed-modal" >
            @else
                <video class="col-12 feed">
                    <source src="{{$feed->path}}" type="video/mp4" class="video-feed-modal">
                </video>
            @endif
        </div>
 
    </div>
 
    <hr class="line">
 
    <div class="row">
        <div class="col-12 tools-feed " style="display: inherit;">
            <div class="mr-3" id="likeDiv">
                <a id="like-tool" class="ml-3"><i class="" id="like-icon"></i></a><sapn id="like-count"></span>
            </div>
                
            <div class="mr-3">
                <a id="comment-tool" href="#"><i class="far fa-comment m-1 fa-lg" id="comment-icon"></i></a><sapn id="comment-count">{{$commentCount}}</span>
            </div>

            <div class="mr-3">
                <a id="view-tool" href="#"><i class="far fa-eye m-1 fa-lg" id="eye-icon"></i></a><sapn id="view-count">{{views($feed)->count()}}</span>
            </div>
        </div>
    </div>

    <hr class="line">

    <div class="row">
        <div class="col-12 description-feed-modal">
            <p>
                {{$feed->description}}
            </p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 comment-div mt-3">
            <form id="comment-form">
                @csrf()
                <div class="input-group">
                    <input type="text" class="form-control" name="description" id="description-input" placeholder="Comment...">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
            @foreach($comments as $comment)
                <div class="comments-feed-modal">
                    <b>{{$comment->user->name}}:</b>
                    {{$comment->description}}
                </div>
            @endforeach
            
        </div>
    </div>


                       
@endsection

@push('scripts')
    <script>
        feedId = {{$feed->id}};
        $(document).ready(function () {
            likeCount(feedId)
            $("#comment-form").submit(function (event) {
                var formData = {
                    description: $("#description-input").val(),
                    _token: "{{ csrf_token() }}",
                };

                $.ajax({
                    type: "POST",
                    url: "{{route('comment.store',$feed->id)}}",
                    data: formData,
                    success: function(){
                        location.reload(true);
                    },
                })

                event.preventDefault();
            });

            $('#like-tool').click(function (event) {
                $.ajax({
                    type: "get",
                    url: "{{route('like.index',$feed->id)}}",
                    success: function(){
                        likeCount(feedId)
                    },
                })
            });
        });

        function likeCount(feedId) {
            Url = '{{route('like.likeCount',':feedId')}}';

            $.ajax({
                type: "get",
                url: Url.replace(':feedId',feedId),
                success: function(response){
                    $('#like-icon').removeClass("fas fa-heart m-1 fa-lg red-heart")
                    if(response.isLiked == true){
                        $('#like-icon').addClass("fas fa-heart m-1 fa-lg red-heart");
                        console.log('true')
                    }else{           
                        $('#like-icon').addClass("far fa-heart m-1 fa-lg ");   
                        console.log('false')
                    }
                    $("#like-count").text(response.reactionCounters);

                },
            })

        }

    </script>
@endpush
