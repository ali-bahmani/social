@extends('layouts.app')

@section('content')

<div class="container">
    <button type="button" class="btn btn-primary btn-lg shadow-lg" data-toggle="modal" data-target="#newFeed">
    <i class="fa fa-plus" aria-hidden="true"></i> New Feeds!
    </button>

    <div class="modal fade" id="newFeed" tabindex="-1" role="dialog" aria-labelledby="newFeedTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{route('submit')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create New Feed!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <img>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-form-label" >Description: </label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="row justify-content-center">



        @foreach($feeds as $feed)
            <div class="col-4 mt-3">
                <div class="card">
                    <div>
                        <a>
                            <img src="{{asset('images/avatar1.png')}}" alt="Avatar" class="avatar"> 
                        </a>

                        <a>
                            <span>{{$feed->user->name}}</span>
                        </a>
                    </div>
                    
                    @if($feed->type == 'image')
                        <img src="{{$feed->path}}" class="img-thumbnail">       
                    @elseif($feed->type == 'video')
                        <video class="video">
                            <source src="{{$feed->path}}" type="video/mp4">
                        </video>
                    @endif
        
                    <div class="card-body">
                        <g>{{$feed->description}}</g>
                    </div>
                    
                    <div class="ml-3">
                        <i class="far fa-eye m-1"></i><sapn>200k</span>
                    </div>

                    <div class="m-3">
                        <i class="far fa-heart m-1"></i><sapn>30k</span>
                        <i class="far fa-comment m-1"></i>
                    </div>
                    
                </div>

            </div>
        @endforeach
        

        
    </div>
</div>
@endsection

<style>
.avatar {
  vertical-align: middle;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin: 10px
}

.video {
    height: 350px;
}
</style>