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


    // public function auth_login_admin(Request $request)
    // {
    //     $user = User::where('email', $request->email)->first();

    //     if ($user != null && Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_deleted' => 0])) {
    //         return redirect('admin/dashboard');
    //     } elseif ($user != null && Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0])) {
    //         return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman admin');
    //     } elseif ($user != null && Hash::check($request->password, $user->password)) {
    //         $token = $user->createToken('Personal Access Token')->plainTextToken;
    //         $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login! Welcome Back'];
    //         return response()->json($response);
    //     } elseif ($user == null) {
    //         $response = ['status' => 500, 'message' => 'No account found with this email'];
    //         return response()->json($response);
    //     } else {
    //         $response = ['status' => 500, 'message' => 'Wrong email or password! please try again'];
    //         return response()->json($response);
    //     }
    // }

    // public function logout_admin(Request $request)
    // {
    //     try {
    //         $request->user()->currentAccessToken()->delete();
    //         Auth::logout();
    //         return redirect('admin')->with('success', 'Logout Successfully');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Logout Failed');
    //     }
    // }
}
