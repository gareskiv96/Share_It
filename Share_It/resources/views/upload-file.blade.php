@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 upload-container">          
            <a href="{{route('file')}}" class="btn btn-primary btn-lg btn-block">Upload File <i class="fas fa-file-upload"></i></a>            
        </div>
    </div>
</div>
@endsection
