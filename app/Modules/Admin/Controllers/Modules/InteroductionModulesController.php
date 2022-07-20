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
use App\Modules\Admin\Models\Modules\InteroductionModule;
use App\Modules\Admin\Models\Modules\InteroductionModuleData;
use App\Modules\Admin\Models\Modules\ModulesContent;

class InteroductionModulesController extends Controller
{
    protected function index()
    {
        if (request()->ajax()) {

            $inter_modules = InteroductionModule::with([
                    'data' => function($query){

                    $query->where('lang_id' , Lang::getSelectedLangId());
                },
            ])->orderBy('id' , 'desc')->get();

                    return DataTables::of($inter_modules)
                ->editColumn('options', function($query) {
                    $html = '';
                    if(Auth::user()->hasPermissionTo('Update_modules')){

                        $html .= "<a href='" . route('interoduction_modules.edit', $query->id) . "' class='btn waves-effect waves-light btn-success text-center edit-row mr-1 ml-1' data-id='" . $query->id . "'  data-title='" . $query->title . "'  data-description='" . $query->description . "' data-url='" . route('interoduction_modules.edit', $query->id) . "'>" . _i('Edit') . "</a>";
                    }
                    if(Auth::user()->hasPermissionTo('Delete_modules')){

                        $html .= "<a href='" . route('interoduction_modules.delete', $query->id) . "' class='btn btn-danger btn-delete datatable-delete mr-1 ml-1' data-id='" . $query->id . "'>" . _i('Delete') . "</a>";
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
                })->editColumn('image', function($query) {
                    $image = asset(rawurlencode($query->image));
                    $html = "<img class='img-thumbnail' width=100 height=100 src=".$query->getImageNameEncoded().">";
                    return $html;
                })->editColumn('created_at', function($query) {
                    return Utility::dates($query->created_at);
                })

                ->rawColumns([
                    'options',
                    'image',
                    'status',
                    'created_at'
                ])
                ->make(true);
        }
        return view('admin.interoduction_modules.index');
    }//End of Index

    protected function create(){

        $languages = Language::get();
        $modules = Modules::with('Data')->get();
        return view('admin.interoduction_modules.create' , compact('languages' , 'modules'));
    }

    protected function store( Request $request )
    {
        // dd($request->all());
        if($request->published) {
            $request->published = 1;
        } else {
            $request->published = 0;
        }


        $image_in_db = NULL;
        if( $request->has('image') )
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $path = public_path().'/uploads/interoduction_modules';
            $image = request('image');
            $image_name = time().request('image')->getClientOriginalName();
            $image->move($path , $image_name);
            $image_in_db = '/uploads/interoduction_modules/'.$image_name;
        }

        $inter_module = InteroductionModule::create([
            'published' => $request->published,
            'image' => $image_in_db,
            'module_id' => $request->module_id,
        ]);

        InteroductionModuleData::create([
            'inter_module_id' => $inter_module->id,
            'lang_id' => Lang::getSelectedLangId(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('interoduction_modules.index');
    }

    protected function edit( $id )
    {
        $modules = Modules::with('Data')->get();
        $inter_module = InteroductionModule::findOrfail($id);
        $inter_module_data = InteroductionModuleData::where('inter_module_id' , $inter_module->id)->first();

        return view('admin.interoduction_modules.edit' , compact('modules' , 'inter_module' , 'inter_module_data'));
    }//End Of Edit

    protected function update(Request $request , $id)
    {
        $inter_module = InteroductionModule::findOrfail($id);

        if($request->published) {
            $request->published = 1;
        } else {
            $request->published = 0;
        }

        if(! $request->image) {
            $image_in_db = $inter_module->image;
        } else {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);

            $image_path = public_path($inter_module->image);
            if (file_exists(public_path($inter_module->image))) {
                unlink($image_path);
            }
            $path = public_path().'/uploads/interoduction_modules';
            $image = request('image');
            $image_name = time().request('image')->getClientOriginalName();
            $image->move($path , $image_name);
            $image_in_db = '/uploads/interoduction_modules/'.$image_name;
        }

        InteroductionModule::where('id' , $id)->update([
            'image'	=> $image_in_db,
            'published' => $request->published
        ]);


        InteroductionModuleData::where('inter_module_id' , $inter_module->id)->update([

            'inter_module_id' => $inter_module->id,
            'title' => $request->title,
            'body' => $request->body,
            'lang_id' =>  Lang::getSelectedLangId(),
        ]);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('interoduction_modules.index');
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
        $inter_module = InteroductionModule::where('id', $id)->first();
        $inter_module->delete();
        InteroductionModuleData::where('inter_module_id' , $id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('interoduction_modules.index');

    }//End Of Delete


}
