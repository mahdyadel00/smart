<?php

namespace App\Modules\Admin\Controllers\GroupModule;

use App\Bll\Lang;
use App\Bll\Utility;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Modules\Admin\Models\GroupModule\GroupModule;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Modules\Modules;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GroupModuleController extends Controller
{

    protected function index()
    {
        $group_module = GroupModule::get();
        if (request()->ajax()) {
            return DataTables::of($group_module)
                ->editColumn('options', function ($query) {
                    $html = '';
                    // if (Auth::user()->hasPermissionTo('Update_content_module')) {

                        $html .= "<a href='" . route('group_module.edit', $query->id) . "' class='btn waves-effect waves-light btn-success text-center edit-row mr-1 ml-1' data-id='" . $query->id . "'  data-title='" . $query->title . "'  data-description='" . $query->description . "' data-url='" . route('group_module.edit', $query->id) . "'>" . _i('Edit') . "</a>";
                    // }
                    // if (Auth::user()->hasPermissionTo('Delete_content_module')) {

                        $html .= "<a href='" . route('group_module.delete', $query->id) . "' class='btn btn-danger btn-delete datatable-delete mr-1 ml-1' data-id='" . $query->id . "'>" . _i('Delete') . "</a>";
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

             })->editColumn('title', function ($query) {
              
                    return $query->title;

            })->addColumn('created_at', function ($query) {

                return Utility::dates($query->created_at);
           
            })->rawColumns([
                    'options',
                    'goal',
                    'video',
                    'created_at',
                ])
                ->make(true);
        }

        return view('admin.group_module.index');
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
        return view('admin.group_module.create', compact('languages' , 'modules'));
    }// End of Create

    protected function store(Request $request)
    {

        $group_module = GroupModule::create([
            'title' => $request->title,
            // 'module_id' => $request->module_id,
        ]);

        $group_module->save();

        return redirect()->route('group_module.index')->with('flash_message', _i('Added Successfully !'));

    }

    protected function edit($id)
    {
        $modules = Modules::with('Data')->get();
        $group_module = GroupModule::findOrFail($id);

        return view('admin.group_module.edit', compact('group_module' , 'modules'));
    }//End of Edit

    protected function update(Request $request, $id)
    {
        // dd($request->all());
        $group_module = GroupModule::where("id", $id)->first();

        GroupModule::where('id' , $id)->update([

            // 'module_id' => $request->module_id,
            'title' => $request->title,
            // 'video' => $video_in_db,
        ]);


        return redirect()->route('group_module.index')->with('flash_message', _i('Updated Successfully !'));
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
        $group_module = GroupModule::where('id', $id)->first();
        $group_module->delete();
        // $avtivity_module_data = ActivityModuleData::where('activity_id', $id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }
}
