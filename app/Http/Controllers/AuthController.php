<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessTokenResult;

class AuthController extends Controller
{
    public function login_admin()
    {
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1 ) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_deleted' => 0], $remember)) {
            return redirect('admin/dashboard');
        } if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman admin');
        } else {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);
        if(empty($checkEmail)) {
            $save = new User;
            $save->name = $request->name;
            $save->email = $request->email;
            $save->password = Hash::make($request->password);
            $save->save();

            $json['status'] = 'true';
            $json['message'] = 'Registrasi berhasil';
        } else {
            $json['status'] = 'false';
            $json['message'] = 'Email sudah terdaftar';
        }
        echo json_encode($json);
    }

}
