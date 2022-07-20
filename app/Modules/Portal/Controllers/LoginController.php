<?php

namespace App\Modules\Portal\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Login\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use  App\Models\User;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    protected function login(){

        $login = Login::with('Data')->first();

        return view('site.login' , compact('login'));
    }

    protected function store(Request $request){

        // dd($request->all());
        // $request->validate([
        //     'email' => 'required|unique:users',
        //     'password' => 'required|confirmed',
        // ]);

        $request_data = $request->except([ 'password_confirmation' , '_token']);

        Auth::attempt($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('home');

    }

    protected function logout(){

        Auth::logout();

        return redirect()->route('home');
    }

    protected function myProfile(){

        return view('site.profile');
    }

    protected function edit(Request $request , $id){

        $user = User::findOrfail($id);

        $user->where('id' , $id)->update([

            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }

}
