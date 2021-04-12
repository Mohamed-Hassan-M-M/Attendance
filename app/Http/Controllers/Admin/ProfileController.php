<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }
    public function overview()
    {
        $view = view('admin.profile.overview')->render();
        return response()->json([
            'status'=>true,
            'view'=>$view
        ]);
    }
    public function editProfile()
    {
        $view = view('admin.profile.editProfile')->render();
        return response()->json([
            'status'=>true,
            'view'=>$view
        ]);
    }
    public function updateProfile(UserRequest $request)
    {
        Auth::guard('web')->user()->name = $request->name;
        Auth::guard('web')->user()->email = $request->email;
        Auth::guard('web')->user()->save();
        $view = view('admin.profile.overview')->render();
        return response()->json([
            'status'=>true,
            'view'=>$view
        ]);
    }
    public function password()
    {
        $view = view('admin.profile.password')->render();
        return response()->json([
            'status'=>true,
            'view'=>$view
        ]);
    }
    public function resetPassword(UserRequest $request)
    {

        if(Hash::check($request->old_password ,auth()->user()->password))
        {
            auth('web')->user()->update(['password'=>Hash::make($request->password)]);
            Auth::guard('web')->logout();
            return response()->json([
                'status'=>true,
            ]);
        }
        else{
            $view = view('admin.profile.password')->render();
            return response()->json([
                'status'=>false,
                'view'=>$view,
                'error'=>'Your password is wrong'
            ]);
        }
    }
}
