<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessTokenResult;

class AuthFlutterController extends Controller
{
  function SignIn(Request $request)
  {
      $user = User::where('email', $request->email)->first();

      if ($user != '[]' && Hash::check($request->password, $user->password)) {
          $token = $user->createToken('Personal Access Token')->plainTextToken;
          $requestesponse = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login! Welcome Back'];
          return response()->json($requestesponse);
      } else if ($user == '[]') {
          $requestesponse = ['status' => 500, 'message' => 'No account found with this email'];
          return response()->json($requestesponse);
      } else {
          $requestesponse = ['status' => 500, 'message' => 'Wrong email or password! please try again'];
          return response()->json($requestesponse);
      }
  }

  function SignUp(Request $request)
  {
    try {
      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
      ]);
  
      return response()->json([
          'status' => 200,
          'message' => 'Successfully registered',
          'user' => $user,
      ]);
  } catch (\Exception $e) {
      return response()->json([
          'status' => 500,
          'message' => 'Failed to register user',
          'error' => $e->getMessage(), // Menampilkan pesan kesalahan
      ]);
  }
  }

  //    logout
  function SignOut(Request $request)
  {
      try {
          $request->user()->currentAccessToken()->delete();
          return response()->json([
              'status' => 200,
              'message' => 'Logout Successfully',
          ]);
      } catch (\Throwable $th) {
          return response()->json([
              'status' => 500,
              'message' => 'Logout Failed',
          ]);
      }
  }
}
