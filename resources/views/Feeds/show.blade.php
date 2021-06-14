@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="close fancybox-button " data-fancybox-close=""  >
                <span aria-hidden="true">&times;</span>
            </button>

            <a href="{{route('profile.userProfile',$feed->user->id)}}" style="margin-bottom: 0px;">
                <img src="{{$feed->user->avatar_path}}" alt="Avatar" class="avatar"> 
                <span>{{$feed->user->name}}</span>
            </a>
        </div>
    </div>

    <hr style="margin-top: 0px;border-top: 2px solid rgba(0,0,0,.1);">

    <div class="row">
        <div class="col-12">
            @if($feed->type == 'image')
                <img src="{{$feed->path}}" class="col-12 feed" >
            @else
                <video class="col-12 feed">
                    <source src="{{$feed->path}}" type="video/mp4">
                </video>
            @endif
        </div>
 
    </div>
 
    <hr style="border-top: 2px solid rgba(0,0,0,.1);">
 
    <div class="row">
        <div class="col-12 tools " style="display: inherit;">
            <div class="mr-3" id="likeDiv">
                <a id="like" class="ml-3"><i class="" id="likeIcon"></i></a><sapn id="countLike"></span>
            </div>
                
            <div class="mr-3">
                <a href="#"><i class="far fa-comment m-1 fa-lg"></i></a><sapn>{{$commentCount}}</span>

            </div>

            <div class="mr-3">
                <a href="#"><i class="far fa-eye m-1 fa-lg"></i></a><sapn>{{views($feed)->count()}}</span>

            </div>

        </div>
    </div>
    <hr style="border-top: 2px solid rgba(0,0,0,.1);">
    <div class="row">
        <div class="col-12 description">
            <p>
                {{$feed->description}}
            </p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 comment mt-3">
            <form id="commentForm">
                @csrf()
                <div class="input-group">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Comment...">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
        @foreach($comments as $comment)
            <div class="show-comments">
            <b>{{$comment->user->name}}:</b>
                {{$comment->description}}
            </div>
        @endforeach
            
        </div>
    </div>

    </div>
         
    </div>
                       
@endsection

@push('scripts')

    <script>
    feedId = {{$feed->id}};
        $(document).ready(function () {
            likeCount(feedId)
            $("#commentForm").submit(function (event) {
                var formData = {
                    description: $("#description").val(),
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

            $('#like').click(function (event) {
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
<style>
.feed {
    display: block;
    margin-left: auto;
    margin-right: auto;


}
.tools{
    font-size: 20px;
    color: black;
}

.tools a{
    color:black;
}
.description p{
    margin: 0 0 0 20px;
}
.comment{
    margin:
}
.show-comments{
    margin-left:20px;
}

.red-heart{
    color: #ed4956;
}

</style>