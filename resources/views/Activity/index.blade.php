@extends('layouts.app')

@section('content')
<div class="container">

  <ul class="nav nav-tabs">
    <li><a href="#home" data-toggle="tab">Home</a></li>
    <li><a href="#profile" data-toggle="tab">Profile</a></li>

  </ul>




        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">1</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
        </div>
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
    height: 200px; /* height of container */
    object-fit: cover;
}

.video-feed{
    height: 200px; /* height of container */
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

</script>
@endpush