<?php

namespace App\Modules\Portal\Controllers;

use App\Bll\Lang;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Insturctions\Insturction;
use App\Modules\Admin\Models\Modules\GoalsModules;
use App\Modules\Admin\Models\Modules\Modules;

class ContentController extends Controller
{

    protected function index(Request $request ,  $id){

        $modules = Modules::with([
            'Data' => function($query){
                $query->where('lang_id' ,Lang::getSelectedLangId());
            },
            'interModule.Data',
            'goalModule.Data',
            'InsturcationModule.Data',
        ])->where('id' , $id)->first();
        // dd($modules);
        // $goals_modules = GoalsModules::with('Data')->first();
        // $insturcation_modules = Insturction::with('Data')->first();
        return view('site.modules.home' , compact('modules'));
    }

}
