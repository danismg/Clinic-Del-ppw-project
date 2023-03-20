<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Berhasil nampilin user',
            'user' => $users
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'message' => 'Berhasil nambah user',
            'user' => $user
        ], 201);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $userupdate = User::where('id', $id)->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'message' => 'Berhasil update user',
            'user' => $userupdate
        ], 201);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return response()->json([
            'message' => 'Berhasil hapus user',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $success['token'] = $user->createToken('token')->plainTextToken;
            return response()->json([
                'message' => 'Berhasil login',
                'user' => $user,
                'token' => $success
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gagal login'
            ], 401);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::delete();
        }
        return response()->json([
            'message' => 'Berhasil logout'
        ], 200);
    }
}
