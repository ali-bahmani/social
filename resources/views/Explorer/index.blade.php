@extends('layouts.app')

@section('content')
    <div class="container">

    <!-- <form>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>  -->

        <div class="row justify-content-center">
            @foreach($feeds as $feed)
                <div class="col-4 mt-3" >
                    <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.show',$feed->id)}}" href="javascript:;" class="feed-body">
                        <div class="card">
                            <div class="header-card-feed">
                                <p href="#" style="margin-bottom: 0px;">
                                    <img src="{{$feed->user->avatar_path}}" alt="Avatar" class="profile-picture-mini"> 
                                    <span class="user-name-feed">{{$feed->user->name}}</span>
                                </p>
                            </div>
                        
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

</script>
@endpush