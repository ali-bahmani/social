@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row">
        <div class="col-12" style="text-align: center;font-size: 24px;">

            <span>Notifications</span>
        </div>
    </div>

    @foreach($notifications as $notification)
    
        @switch($notification['data']['type'])
            @case('follow')
                <div class="row">
                    <div class="col-12 d-flex justify-content-between mt-3">
                        <div class="notificationTitle">
                            <a href="{{route('profile.userProfile',$notification['data']['follower_id'])}}"><span>"{{$notification['data']['username']}}" followed you</span></a>
                        </div>

                        <div class="m-3">
                            
                            <i class="far fa-user fa-3x"></i>
                            
                        </div>

                    </div>
                </div>
                <hr/>
                @break

            @case('like')
                <div class="row">
                    <div class="col-12 d-flex justify-content-between mt-3">
                        <div class="notificationTitle">
                            <a href=""><span>"{{$notification['data']['username']}}" liked your feed</span></a>
                        </div>

                        <div class="m-3">
                            
                            <i class="far fa-heart fa-3x"></i>
                            
                        </div>

                    </div>
                </div>
                <hr/>
                @break

            @case('comment')
            <div class="row">
                <div class="col-12 d-flex justify-content-between mt-3">
                    <div class="notificationTitle">
                    <a href=""><span>"{{$notification['data']['username']}}" left a comment for you</span></a>
                    </div>

                    <div class="m-3">
                        
                        <i class="far fa-comment fa-3x"></i>
                        
                    </div>

                </div>
            </div>
            <hr/>
            @break

        @endswitch

    @endforeach

        
</div>
@endsection



@push('scripts')
<script>


</script>
@endpush
