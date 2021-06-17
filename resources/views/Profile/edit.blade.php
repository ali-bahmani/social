@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="close fancybox-button " data-fancybox-close=""  >
                <span aria-hidden="true">&times;</span>
            </button>

            <span>Edit Profile</span>
        </div>
    </div>

    <form  enctype="multipart/form-data" id="profile-form" action="{{route('profile.edit')}}" method="post">
        @csrf
            <div class="previewImg-div">
                <img id="previewImg" class="img-thumbnail">
            </div>

            <input name="_method" type="hidden" value="PUT">
            
            <div class="form-group">
                <label for="username" class="col-form-label" >Username: </label>
                <input type="text" class="form-control" id="username" name="username" value="{{$user->name}}"></textarea>
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label" >Email: </label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"></textarea>
            </div>

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="file" onChange="previewFile(this)" value="{{$user->avatar_path}}">
                <label class="custom-file-label" for="customFile">Choose Avatar</label>
            </div> 

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

    </form>                 
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