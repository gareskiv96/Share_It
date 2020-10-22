@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-right">
            @if(Auth::user())
                <a href="{{route('file')}}" class="back-btn btn btn-primary">Go back <i class="fas fa-arrow-left"></i></a>
            @endif
            </div>
        </div>       
        <div class="row">
            @if(count($files) == 0)
                <div class="col-md-12">
                    <h3 class="text-center">You have no files uploaded yet.</h3>                  
                </div>
            @else
                <table class="table">
                    <thead>
                        <tr>                   
                            <th class="text-center" scope="col">File Name</th>
                            <th class="text-center" scope="col">Show & Share</th>
                            <th class="text-center" scope="col">&nbsp;</th>
                            <th class="text-center" scope="col">Total Downloads</th>                       
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $file)
                        <tr>                    
                            <td class="text-center">{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->filename)}}</td>
                            <td class="text-center"><a href="{{route('link', [$file->id , $file->code] )}}">http://{{$host}}/{{$file->id}}{{$file->code}}</a></td>
                            <td class="text-center">
                                <form method="POST" action="{{route('delete', $file->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                            <td class="text-center">{{$file->total_downloads}}</td>
                        </tr>
                    @endforeach                    
                    </tbody>
                </table>
            @endif
        </div>       
    </div>
@endsection