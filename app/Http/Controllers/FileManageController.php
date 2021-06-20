<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as LibFile;
use App\Models\FileType;use App\Models\File;use App\Models\FileDoc;
class FileManageController extends Controller
{
    public function Index(){
    	$title 		= "Files";
        $getFiles   = File::paginate(1);
    	return View('files.index',compact('title','getFiles'));
    }
    public function Details($id){
        $title = "File Documents";
        $getFiledoc   = FileDoc::where('file_id',$id)->paginate(1);
        return View('files.details',compact('title','getFiledoc','id'));
    }
    public function DocSearch(Request $request){
        $title = "File Documents";
        $id = $request->id;
        $getFiledoc   = FileDoc::where('file_id',$id)->where('title',$request->search)->get();
        return View('files.details',compact('title','getFiledoc','id'));
    }
    public function DocFilter(Request $request){
        $title = "File Documents";
        $id = $request->id;
        if($request->filter == 'a'){
            $getFiledoc   = FileDoc::where('file_id',$id)->orderBy('id', 'ASC')->get();
        }else{
            $getFiledoc   = FileDoc::where('file_id',$id)->orderBy('id', 'DESC')->get();
        }
        
        return View('files.details',compact('title','getFiledoc','id'));
    }
    public function saveFile(Request $request){
        
        // return $request['doc_file'][1];
        // return pathinfo(asset($request['doc_file'][0]), PATHINFO_EXTENSION);
        // return $request['doc_file'][0]->getSize();
        $getType = FileType::get();
        $create = New File();

        $create->title          = $request->title;
        $create->color_code 	= $request->color_code;
        // $create->password 	    = $request->password;

        $create->save();


        for ($e= 0; $e < count($request->get('doc_title')); $e++){
            $insert                 = New FileDoc();
            $docoment   			= $request['doc_file'][$e];
            if($docoment){

                $doc                = rand().$request['doc_file'][$e]->getClientOriginalName();
                $destination        = 'uploads/'.$request->title.'/';
                $request['doc_file'][$e]->move($destination, $doc);

                $insert->doc_file   = $destination.'/'.$doc;

            }
            $insert->file_id 	    = $create->id;
            $insert->title 	        = $request['doc_title'][$e];

            $insert->save();
        }
        notify()->success('File Added Successfully !');
        return redirect()->back();
    }
    public function updateFile(Request $request){
        // return $request['doc_file'][1];

        $update = File::where('id', $request->id)
	            ->update([
	               'title'          => $request->title,
	               'color_code' 	=> $request->color_code
	            ]);

        notify()->success('File Updated Successfully !');
        return redirect()->back();
    }
    public function saveDoc(Request $request){
        $getFiles   = File::where('id',$request->file_id)->first();
        for ($e= 0; $e < count($request->get('doc_title')); $e++){
            $insert                 = New FileDoc();

            $docoment   			= $request['doc_file'][$e];
            if($docoment){
                $doc                = rand().$request['doc_file'][$e]->getClientOriginalName();
                $destination        = 'uploads/'.$getFiles->title;
                $request['doc_file'][$e]->move($destination, $doc);

                $insert->doc_file   = $destination.'/'.$doc;
            }
            $insert->file_id 	    = $request->file_id;
            $insert->title 	        = $request['doc_title'][$e];

            $insert->save();
        }
        notify()->success('File Added Successfully !');
        return redirect()->back();
    }
    public function FileEdit($id){
        $getFiledoc   = File::where('id',$id)->first();
        return View('files.Fileform',compact('getFiledoc'));
    }
    public function FileDelete($id){
        $getFiledoc   = File::where('id',$id)->delete();
        return redirect()->back();
    }
    public function DocDelete($id){
        $getdoc   = FileDoc::where('id',$id)->first();
        $image_path = $getdoc->doc_file;

        if(LibFile::exists($image_path)) {
            LibFile::delete($image_path);
        }
        $getFiledoc   = FileDoc::where('id',$id)->delete();
        return redirect()->back();
    }
    public function Setup(){
        $title = "File Setup";
        $getFileType = FileType::get();
        return View('files.setup',compact('title','getFileType'));
    }
    public function SetupEdit($id){
        $title = "File Setup";
        $FileType = FileType::where('id',$id)->first();
        return View('files.form',compact('title','FileType'));
    }
    public function SetupDelete($id){
        $title = "File Setup";
        $FileType = FileType::where('id',$id)->delete();
        return "success";
    }
    public function saveFileType(Request $request){

        $create = New FileType();

        $create->type_title = $request->type_title;
        $create->file_size 	= $request->file_size;

        $create->save();
        notify()->success('User Added Successfully !');
        return redirect()->back();
    }
    public function updateFileType(Request $request){
        $update = FileType::where('id', $request->id)
	            ->update([
	               'type_title' => $request->type_title,
	               'file_size' 	=> $request->file_size
	            ]);
        notify()->success('User Updated Successfully !');
        return redirect()->back();
    }
}
