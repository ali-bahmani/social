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
                <a data-options='{"modal":"true"}' data-fancybox data-type="ajax" data-src="{{Route('feed.show',$feed->id)}}" href="javascript:;" class="main">
                    <div class="card">
                        <div>
                            <p href="#" style="margin-bottom: 0px;">
                                <img src="{{$feed->user->avatar_path}}" alt="Avatar" class="avatar"> 
                                <span>{{$feed->user->name}}</span>
                            </p>


                        </div>
                    
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
</style>

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