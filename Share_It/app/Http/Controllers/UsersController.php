<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileUploadRequest;


use App\User;
use App\File;

class UsersController extends Controller
{   

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function file() 
    {
        $id = \Auth::user()->id;
          
        return view('file-form', Compact('id'));
    }

    public function chooseFile(FileUploadRequest $request) 
    {
        $blacklist_mimes = ["image/bmp", "image/x-ms-bmp", "mage/x-windows-bmp", "application/octet-stream", "application/x-msdownload", "application/x-httpd-php"];
        
        $input = $request->all();

        $upload = new File;             
        
        $file = $request->file('fileUpload');

        $size = $request->file('fileUpload')->getSize(); 
        $convert = $this->formatSizeUnits($size);

        $mime = $request->file('fileUpload')->getMimeType();
        
        if (in_array($mime, $blacklist_mimes)) {                  
            \Session::flash('blackList');
            return back();   
        }

        $file->move('uploads', $file->getClientOriginalName());     

        $upload->user_id = $request->user()->id;
        $upload->filename = $file->getClientOriginalName(); 
        $upload->size = $convert; 
        $upload->code = \Str::random(6);

        if($upload->save()) {
            \Session::flash('success');
            return back();
        } 
        if(!$upload->save()) {
            \Session::flash('failed');
            return back(); 
        }        
    }

    public function showFiles(Request $request, $id) 
    {  
        $host = $request->getHttpHost();  

        $files = File::where('user_id', $id)->get();        
            
        return view('my-files', Compact('files', 'host'));
    }

    public function generateLink($id)
    {        
        $files = File::where('id', $id)->first();       

        if(!$files) {
            return back();
        }
        return view('file', Compact('files'));
    }
    

    public function deleteFile(Request $request) 
    {   
        $file = File::where('id', $request->id)->pluck('filename')->first();   
       
        $file_path = public_path('uploads/'. $file);
      
        File::destroy($request->id);

        if($file_path == 1){
            unlink($file_path);
        }       

        return back();
    }

    public function downloadFile($id) 
    {             
        $file = File::find($id);
        if(!$file) {

            if(\Auth::user()) {
                return redirect('upload-file');
            }

            return redirect('/');           
        }
        $file_path = public_path('/uploads/'.$file->filename);    
       
          
        $increment = $file->increment('total_downloads');        
        $file->save();

        return \Response::download($file_path, $file->filename);             
    }   
}
