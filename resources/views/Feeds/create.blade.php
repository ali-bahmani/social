@extends('layouts.modal')

@section('title')
Create New Feed!
    
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <button type="button" class="close fancybox-button " data-fancybox-close=""  >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form method="post" action="{{route('feed.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="previewImg-div">
                <img id="previewImg" class="img-thumbnail">
            </div>
            
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="file" onChange="previewFile(this)">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label" >Description: </label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
                
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Post</button>
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