<?php

namespace App\Modules\Portal\Controllers;

use App\Bll\Lang;
use App\Bll\Utility;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Main\Main;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Help\Help;
use App\Modules\Admin\Models\Main\MainGoals;
use App\Modules\Admin\Models\Main\Insturcation;
use Illuminate\Support\Facades\Auth;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class HomeController extends Controller
{

    public function index(){

        $main = Main::with('Data')->first();
        $main_goals = MainGoals::with('Data')->first();
        $main_insturcation = Insturcation::with('Data')->first();
        $help = Help::with('data')->first();
        return view('site.home' , compact('main' , 'main_goals' , 'main_insturcation' , 'help'));
    }



    public function changeHomeLang($locale = null)
    {

        App::setLocale($locale);
        LaravelGettext::setLocale($locale);
        session()->put('locale', $locale);
        $language = Language::where('code', $locale)->first();
        if ($language != null) {
            session()->put('lang_id', $language['id']);
            session()->put('lang', $language['code']);
        }
        return  redirect()->back();
    }


    public function addUserGroup(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();

        $user->group_id = $request->val;
        $user->save();

        return response('success');
    }




}
