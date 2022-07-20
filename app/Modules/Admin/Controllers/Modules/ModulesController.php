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
use App\Modules\Admin\Models\GroupModule\GroupModule;
use App\Modules\Admin\Models\Modules\ModulesData;
use App\Modules\Admin\Models\Modules\ModulesContent;

class ModulesController extends Controller
{
    protected function index()
    {
        if (request()->ajax()) {

            $modules = Modules::with([
                'content',
                'data' => function($query){

                    $query->where('lang_id' , Lang::getSelectedLangId());
                },
            ])->get();

                    return DataTables::of($modules)
                ->editColumn('options', function($query) {
                    $html = '';
                    if(Auth::user()->hasPermissionTo('Update_modules')){

                        $html .= "<a href='" . route('modules.edit', $query->id) . "' class='btn waves-effect waves-light btn-success text-center edit-row mr-1 ml-1' data-id='" . $query->id . "'  data-title='" . $query->title . "'  data-description='" . $query->description . "' data-url='" . route('modules.edit', $query->id) . "'>" . _i('Edit') . "</a>";
                    }
                    if(Auth::user()->hasPermissionTo('Delete_modules')){

                        $html .= "<a href='" . route('modules.delete', $query->id) . "' class='btn btn-danger btn-delete datatable-delete mr-1 ml-1' data-id='" . $query->id . "'>" . _i('Delete') . "</a>";
                    }
                    if(Auth::user()->hasPermissionTo('Lnag_modules')){


                    $langs = Language::get();
                    $options = '';
                    foreach ($langs as $lang) {
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$query->id.'" data-lang="'.$lang->id.'"
						style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                    }
                    // $html = $html.'
					//  <div class="btn-group">
					//    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
					// 	 <span class="ti ti-settings"></span>
					//    </button>
					//    <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
					// 	 '.$options.'
					//    </ul>
					//  </div> ';
                }
                    return $html;
                })->editColumn('title', function($query) {

                        return $query->data->isNotEmpty() ? $query->data->first()->title : ' ';

                })->editColumn('status', function($query) {
                    if ($query->status == 0){
                        return '<div class="badge badge-warning">'. _i('Disabled') .'</div>';
                    }else {
                        return '<div class="badge badge-info">'. _i('Enabled') .'</div>';
                    }
                })->editColumn('created_at', function($query) {
                    return Utility::dates($query->created_at);
                })

                ->rawColumns([
                    'options',
                    'status',
                    'created_at'
                ])
                ->make(true);
        }
        return view('admin.modules.index');
    }//End of Index

    protected function create(){

        $languages = Language::get();
        $group_module = GroupModule::all();
        return view('admin.modules.create' , compact('languages' , 'group_module'));
    }

    protected function store( Request $request )
    {
        if($request->published) {
            $request->published = 1;
        } else {
            $request->published = 0;
        }


        $module = Modules::create([
            'published' => $request->published,
            'group_module_id' => $request->group_module_id,
        ]);
        ModulesData::create([
            'module_id' => $module->id,
            'lang_id' => Lang::getSelectedLangId(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('modules.index');
    }

    protected function edit( $id )
    {
        $module = Modules::find($id);
        $group_module = GroupModule::all();
        $module_data = ModulesData::where('module_id' , $module->id)->first();

        return view('admin.modules.edit' , compact('module' , 'module_data' , 'group_module'));
    }//End Of Edit

    protected function update(Request $request , $id)
    {

        if($request->published) {
            $request->published = 1;
        } else {
            $request->published = 0;
        }
        $module = Modules::findOrfail($id);

        Modules::where('id' , $id)->update([
            'published' => $request->published,
            'group_module_id' => $request->group_module_id,

        ]);

        ModulesData::where('module_id' , $module->id)->update([

            'module_id' => $module->id,
            'title' => $request->title,
            'body' => $request->body,
            'lang_id' =>  Lang::getSelectedLangId(),
        ]);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('modules.index');
    }
    protected function getTranslation(Request $request)
    {
        $rowData = ModulesData::where('feature_id', $request->transRow)
            ->where('lang_id', $request->lang_id)
            ->first(['title' , 'body']);
        if (!empty($rowData)){
            return response()->json(['data' => $rowData]);
        }else{
            return response()->json(['data' => false]);
        }
    }//EEnd Of Get Translation

    protected function storeTranslation(Request $request)
    {
        $rowData = ModulesData::where('module_id', $request->id)
            ->where('lang_id' , $request->lang_id)
            ->first();
        if ($rowData != null) {
            $rowData->update([
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }else{
            ModulesData::create([
                'title'  => $request->title,
                'body'   => $request->body,
                'lang_id' => $request->lang_id,
                'module_id' => $request->id,
            ]);
        }
        return response()->json("SUCCESS");
    }//eEnd of Store Translation
    protected function delete($id)
    {
        $module = Modules::where('id', $id)->first();
        $module->delete();
        ModulesData::where('module_id' , $id)->delete();
        ModulesContent::where('module_id' , $id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('modules.index');

    }//End Of Delete


}
