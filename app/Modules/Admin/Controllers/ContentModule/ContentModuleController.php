<?php

namespace App\Modules\Admin\Controllers\ContentModule;

use App\Bll\Lang;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Modules\Admin\Models\ContentModule\ContentModule;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Modules\Modules;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContentModuleController extends Controller
{

    protected function index()
    {
        $content_module = ContentModule::get();
        if (request()->ajax()) {
            return DataTables::of($content_module)
                ->editColumn('options', function ($query) {
                    $html = '';
                    // if (Auth::user()->hasPermissionTo('Update_content_module')) {

                        $html .= "<a href='" . route('content_modules.edit', $query->id) . "' class='btn waves-effect waves-light btn-success text-center edit-row mr-1 ml-1' data-id='" . $query->id . "'  data-title='" . $query->title . "'  data-description='" . $query->description . "' data-url='" . route('content_modules.edit', $query->id) . "'>" . _i('Edit') . "</a>";
                    // }
                    // if (Auth::user()->hasPermissionTo('Delete_content_module')) {

                        $html .= "<a href='" . route('content_modules.delete', $query->id) . "' class='btn btn-danger btn-delete datatable-delete mr-1 ml-1' data-id='" . $query->id . "'>" . _i('Delete') . "</a>";
                    // }
                    // if (Auth::user()->hasPermissionTo('Lang_content_module')) {

                    //     $langs = Language::get();
                    //     $options = '';
                    //     foreach ($langs as $lang) {
                    //         $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex"  data-id="' . $query->id . '" data-lang="' . $lang->id . '"
                    //         style="display: block; padding: 5px 10px 10px;">' . $lang->title . '</a></li>';
                    //     }
                        // $html = $html . '
                        // <div class="btn-group">
                        // <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
                        // <span class="ti ti-settings"></span>
                        // </button>
                        // <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                        // ' . $options . '
                        // </ul>
                        // </div> ';
                    // }

                    return $html;

             })->editColumn('goal', function ($query) {

              
                    return $query->title;
                // }
            })->editColumn('video', function($query) {
                // $html = '';
                // return 
                // <video width="320" height="240" controls>
                //              <source src="{{URL::asset("$query->video")}}" type="video/mp4">
                //                  Your browser does not support the video tag.
                // </video>
                return  $query ? url($query->video) : ''; 
           
            })->rawColumns([
                    'options',
                    'goal',
                    'video',
                    'created_at',
                ])
                ->make(true);
        }

        return view('admin.content_modules.index');
    }//End of Index

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        $languages = Language::get();
        $modules = Modules::with('Data')->get();
        return view('admin.content_modules.create', compact('languages' , 'modules'));
    }// End of Create

    protected function store(Request $request)
    {

        $video_in_db = NULL;
        if( $request->has('video') )
        {
            $request->validate([
                'video' => 'mimes:mp4,mov,ogg,qt | max:20000',
            ]);

            $path = public_path().'/uploads/content_modules';
            $video = request('video');
            $video_name = time().request('video')->getClientOriginalName();
            $video->move($path , $video_name);
            $video_in_db = '/uploads/content_modules/'.$video_name;
        }
        $content_module = ContentModule::create([
            'video' => $video_in_db,
            'title' => $request->title,
            'module_id' => $request->module_id,
        ]);

        $content_module->save();

        return redirect()->route('content_modules.index')->with('flash_message', _i('Added Successfully !'));

    }

    protected function edit($id)
    {
        $modules = Modules::with('Data')->get();
        $content_module = ContentModule::findOrFail($id);

        return view('admin.content_modules.edit', compact('content_module' , 'modules'));
    }//End of Edit

    protected function update(Request $request, $id)
    {
        // dd($request->all());
        $content_module = ContentModule::where("id", $id)->first();

        if(! $request->video) {
            $video_in_db = $content_module->video;
        } else {
            // $request->validate([
            //     'video' => 'mimes:mp4,mov,ogg,qt | max:200000',
            // ]);

            $video_path = public_path($content_module->video);
            if (file_exists(public_path($content_module->video))) {
                unlink($video_path);
            }
            $path = public_path().'/uploads/content_modules';
            $video = request('video');
            $video_name = time().request('video')->getClientOriginalName();
            $video->move($path , $video_name);
            $video_in_db = '/uploads/content_modules/'.$video_name;
        }

        ContentModule::where('id' , $id)->update([

            'module_id' => $request->module_id,
            'title' => $request->title,
            'video' => $video_in_db,
        ]);


        return redirect()->route('content_modules.index')->with('flash_message', _i('Updated Successfully !'));
    }//End of Update

    public function getTranslation(Request $request)
    {
        $rowData = QuestionData::where('ads_id', $request->transRow)
            ->where('lang_id', $request->lang_id)
            ->first(['title', 'image']);
        if (!empty($rowData)) {
            $rowData->image = asset($rowData->image);
            return \response()->json(['data' => $rowData]);
        } else {
            return \response()->json(['data' => false]);
        }
    }

    public function storeTranslation(Request $request)
    {
        $ads_data = QuestionData::query()
            ->where('lang_id', $request->lang_id)
            ->where('ads_id', $request->id)
            ->first();
        // dd($ads_data);
        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);
            $path = public_path() . '/uploads/advrtisment';
            $image = request('image');
            $image_name = time() . request('image')->getClientOriginalName();
            $image->move($path, $image_name);
            $image_in_db = '/uploads/advrtisment/' . $image_name;
        } else {
            $image_in_db = null;
        }

        if ($ads_data) {
            if ($image_in_db == null) {
                $image_in_db = $ads_data->image;
            } else {

                $image_path = public_path($ads_data->image);
                if (file_exists(public_path($ads_data->image))) {
                    unlink($image_path);
                }
            }
            QuestionData::where([
                'ads_id' => $request->id,
                'lang_id' => $request->lang_id,
            ])->update([
                'title' => $request->title,
                'image' => $image_in_db,
            ]);
        } else {

            QuestionData::create([
                'title' => $request->title,
                'image' => $image_in_db,
                'ads_id' => $request->id,
                'lang_id' => $request->lang_id
            ]);
        }

        return \response()->json("SUCCESS");
    }

    public function delete($id)
    {
        $content_module = ContentModule::where('id', $id)->first();
        $content_module->delete();
        // $avtivity_module_data = ActivityModuleData::where('activity_id', $id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }
}
