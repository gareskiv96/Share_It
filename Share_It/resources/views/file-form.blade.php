@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Successful upload.
                </div>
            @endif
            @if(Session::has('failed'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                   Upload failed.
                </div> 
            @endif
        </div>
        <div class="col-md-12 text-right">
            <a href="{{route('show-files', $id)}}" class="btn btn-primary">My files <i class="far fa-folder-open"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8 upload-container">           
            <form action="{{route('choose-file')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="fileUpload"><h4>Choose your file:</h4></label><br />
                    <input type="file" name="fileUpload" accept="*" id="fileUpload"> 
                    @error('fileUpload')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror  
                    @if(Session::has('blackList'))
                        <div class="text-danger">File type is not supported.</div>     
                    @endif                               
                </div>          
                <br />      
                <button type="submit" class="btn btn-primary">Upload <i class="fas fa-angle-double-up"></i></button>
            </form>            
        </div>
        <div class="col-md-4"></div>
    </div>    
</div>
@endsection