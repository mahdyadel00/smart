<?php

namespace App\Modules\Admin\Controllers\Modules;

use App\Bll\Lang;
use App\Bll\Utility;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Modules\Admin\Models\Modules\Modules;
use App\Modules\Admin\Models\Modules\ModulesData;
use App\Modules\Admin\Models\Modules\HelpModule;
use App\Modules\Admin\Models\Modules\HelpModuleUpload;

class HelpModulesController extends Controller
{
    protected function index()
    {
        if (request()->ajax()) {

            $help_modules = HelpModule::with('data')->get();

                    return DataTables::of($help_modules)
                ->editColumn('options', function($query) {
                    $html = '';
                    // if(Auth::user()->hasPermissionTo('Update_help_modules')){

                        $html .= "<a href='" . route('help_module.edit', $query->id) . "' class='btn waves-effect waves-light btn-success text-center edit-row mr-1 ml-1' data-id='" . $query->id . "'  data-title='" . $query->title . "'  data-description='" . $query->description . "' data-url='" . route('help_module.edit', $query->id) . "'>" . _i('Edit') . "</a>";
                    // }
                    // if(Auth::user()->hasPermissionTo('Delete_hel_modules')){

                        $html .= "<a href='" . route('help_module.delete', $query->id) . "' class='btn btn-danger btn-delete datatable-delete mr-1 ml-1' data-id='" . $query->id . "'>" . _i('Delete') . "</a>";
                    // }
                    
                    return $html;
                })->editColumn('title', function($query) {

                        return $query->title;

              
                // })->editColumn('image', function($query) {
                //     $image = asset(rawurlencode($query->image));
                //     $html = "<img class='img-thumbnail' width=100 height=100 src=".$query->getImageNameEncoded().">";
                //     return $html;
                })->editColumn('created_at', function($query) {
                    return Utility::dates($query->created_at);
                })

                ->rawColumns([
                    'options',
                    // 'image',
                    'status',
                    'created_at'
                ])
                ->make(true);
        }
        return view('admin.help_modules.index');
    }//End of Index

    protected function create(){

        $languages = Language::get();
        $modules = Modules::with('Data')->get();
        return view('admin.help_modules.create' , compact('languages' , 'modules'));
    }

    protected function store( Request $request )
    {
        // dd($request->all());
        //Pdf or word
        $file_in_db = NULL;
        if( $request->has('file') )
        {
            $request->validate([
                "file" => "required|mimes:pdf|max:10000"
            ]);

            $path = public_path().'/uploads/help_modules';
            $file = request('file');
            $file_name = time().request('file')->getClientOriginalName();
            $file->move($path , $file_name);
            $file_in_db = '/uploads/help_modules/'.$file_name;
        }
       
        $help_module = HelpModule::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $request->file,
           
            'module_id' => $request->module_id,
        ]);

         //Image
         $image_in_db = NULL;
         if( $request->has('image') )
         {
             $request->validate([
                 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
             ]);
 
             $path = public_path().'/uploads/help_modules';
             $image = request('image');
             $image_name = time().request('image')->getClientOriginalName();
             $image->move($path , $image_name);
             $image_in_db = '/uploads/help_modules/'.$image_name;
         }
         //Video
         $video_in_db = NULL;
         if( $request->has('video') )
         {
             $request->validate([
                 'video' => 'mimes:mp4,mov,ogg,qt | max:20000',
             ]);
 
             $path = public_path().'/uploads/help_modules';
             $video = request('video');
             $video_name = time().request('video')->getClientOriginalName();
             $video->move($path , $video_name);
             $video_in_db = '/uploads/help_modules/'.$video_name;
         }
        //  dd($request->all());
         
        HelpModuleUpload::create([
            'module_id' => $request->module_id,
            'help_module_id' => $help_module->id,
            'image' => $image_in_db,
            'video' => $video_in_db,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    }

    protected function edit( $id )
    {
        $modules = Modules::with('Data')->get();
        $help_module = HelpModule::findOrfail($id);
        $help_module_data = HelpModuleUpload::where('help_module_id' , $help_module->id)->first();

        return view('admin.help_modules.edit' , compact('modules' , 'help_module' , 'help_module_data'));
    }//End Of Edit

    protected function update(Request $request , $id)
    {
        $help_module = HelpModule::findOrfail($id);
       
      
        if(! $request->file) {
            $file_in_db = $help_module->file;
        } else {
            $request->validate([
                "file" => "required|mimes:pdf|max:10000"
            ]);

            $file_path = public_path($help_module->file);
            if (file_exists(public_path($help_module->file))) {
                unlink($file_path);
            }
            $path = public_path().'/uploads/goals_modules';
            $file = request('file');
            $file_name = time().request('file')->getClientOriginalName();
            $file->move($path , $file_name);
            $file_in_db = '/uploads/goals_modules/'.$file_name;
        }

        HelpModule::where('id' , $id)->update([
            
            'title' => $request->title,
            'description' => $request->description,
            'module_id' => $request->module_id,
            'file' => $request->file,
        ]);

        if(! $request->image) {
            $image_in_db = $help_module->image;
        } else {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $image_path = public_path($help_module->image);
            if (file_exists(public_path($help_module->image))) {
                unlink($image_path);
            }
            $path = public_path().'/uploads/goals_modules';
            $image = request('image');
            $image_name = time().request('image')->getClientOriginalName();
            $image->move($path , $image_name);
            $image_in_db = '/uploads/goals_modules/'.$image_name;
        }
        //Video
        if(! $request->video) {
            $video_in_db = $help_module->video;
        } else {
            // $request->validate([
            //     'video' => 'mimes:mp4,mov,ogg,qt | max:200000',
            // ]);

            $video_path = public_path($help_module->video);
            if (file_exists(public_path($help_module->video))) {
                unlink($video_path);
            }
            $path = public_path().'/uploads/help_modules';
            $video = request('video');
            $video_name = time().request('video')->getClientOriginalName();
            $video->move($path , $video_name);
            $video_in_db = '/uploads/help_modules/'.$video_name;
        }


        HelpModuleUpload::where('help_module_id' , $help_module->id)->update([

            'help_module_id' => $help_module->id,
            'module_id' => $request->module_id,
            'image' =>  $image_in_db,
            'video' =>  $video_in_db,
        ]);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('goals_modules.index');
    }
  
    protected function delete($id)
    {

        $help_module = HelpModule::where('id', $id)->first();
        $help_module->delete();
        HelpModuleUpload::where('help_module_id' , $id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('goals_modules.index');

    }//End Of Delete


}
