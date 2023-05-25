<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addUsers(Request $request)
    {
        //validate input
        $rules= [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'user_type' => 'required',
            'password' => 'required|min:8',
        ];

        $this->validate($request, $rules);

        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]);

        if($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User creation failed'
            ], 400);
        }

    }

  public function login(Request $request)
  {
      $user = User::where('email', $request->email)->first();

      if (!$user || !Hash::check($request->password, $user->password)) {
          return response()->json([
              'status' => 'failed',
              'message' => 'Invalid credentials'
          ], 401);
      }

      $token = $user->createToken('my-app-token');

      $accessToken = $token->accessToken;
      $tokenType = 'Bearer';
      $expiresAt = $token->token->expires_at;

      return response()->json([
          'message' => 'Login successful. Welcome!',
          'data' => $user,
          'access_token' => $accessToken,
          'token_type' => $tokenType,
          'expires_at' => $expiresAt,
      ]);
  }


public function logout(Request $request)
{
    $request->user()->token()->revoke();

    return response()->json([
        'message' => 'Logout successful'
    ]);
}

public function updateUsers(Request $request)
{
    //validate input
    $rules= [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'user_type' => 'required',
        'password' => 'required|min:8',
    ];

    $this->validate($request, $rules);

    //update user

    $user = User::findOrfail($request->id)->update([
     'name' => $request->name,
     'email' => $request->email,
     'user_type' => $request->user_type,
     'password' => Hash::make($request->password),
   ]);

    if($user) {
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully'
        ], 200);
    } else {
        return response()->json([
            'status' => 'failed',
            'message' => 'User update failed'
        ], 400);
    }
}

public function deleteUser(Request $request)
{
    $user = User::findOrfail($request->id)->delete();

    if($user) {
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ], 200);
    } else {
        return response()->json([
            'status' => 'failed',
            'message' => 'User deletion failed'
        ], 400);
    }
}

}
