@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
            @if(Auth::user())
                <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go back</a>
            @endif
            </div>
            <div class="col-md-12">                                
                <div class="info-container">
                    <h5> File Name: <strong> {{preg_replace('/\\.[^.\\s]{3,4}$/', '', $files->filename)}}<small class="text-muted">.{{\File::extension($files->filename)}}</small></strong></h5>                    
                    <h5> File Size: <strong> {{$files->size}}</strong></h5>
                    <h5> Date Uploaded: <strong> {{date('d F, Y', strtotime($files->created_at))}}</strong></h5>
                    <h5> Total Downloads: <strong> {{$files->total_downloads}}</strong></h5>
                    <div>
                        <a href="{{route('download', $files->id)}}" class="btn btn-primary">Download <i class="fas fa-file-download"></i> </a>
                    </div>
                </div>                     
            </div>
        </div>
    </div>
@endsection