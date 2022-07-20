<?php

namespace App\Modules\Portal\Controllers;

use App\Bll\Lang;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\ActivityModule\ActivityModule;
use App\Modules\Admin\Models\ActivityModule\ActivityModuleUpload;
use App\Modules\Admin\Models\Modules\Modules;

class ContentController extends Controller
{

    protected function index(Request $request, $id)
    {

        $modules = Modules::with([
            'Data' => function ($query) {
                $query->where('lang_id', Lang::getSelectedLangId());
            },
            'interModule.Data',
            'goalModule.Data',
            'InsturcationModule.Data',
        ])->where('id', $id)->first();
        // dd($modules);
        // $goals_modules = GoalsModules::with('Data')->first();
        // $insturcation_modules = Insturction::with('Data')->first();
        return view('site.modules.home', compact('modules'));
    }

    public function fileUpload()
    {
        return view('site.modules.home');
    }

    protected function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);
        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads/avtivity_module_upload'), $fileName);
        ActivityModuleUpload::Create([
            'user_id' => auth()->user()->id,
            'module_id' => $request->id,
            'link' => '/uploads/avtivity_module_upload/'.$fileName
        ]);
        return back()
            ->with('success', 'File has been uploaded successfully');
    }

}
