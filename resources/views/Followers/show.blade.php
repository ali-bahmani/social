@extends('layouts.modal')

@section('content')
<div class="row">
        <div class="col-12">
            <button type="button" class="close fancybox-button " data-fancybox-close=""  >
                <span aria-hidden="true">&times;</span>
            </button>

            <span>Followers</span>
        </div>
    </div>

    @foreach($followers as $follower)
        <div class="row">
            <div class="col-12 d-flex justify-content-between mt-3">
                <div class="m-3">
                    <img src="{{$follower->avatar_path }}"  alt="Avatar" class="profile-picture-mini"> 
                    <span>{{$follower->name}}</span>
                </div>

                <div class="m-3">
                    <button type="button" class="btn btn-info m-1">
                        <span aria-hidden="true">Follow</span>
                    </button>
                </div>

            </div>

        </div>

    @endforeach
 

</div>
                       
@endsection
