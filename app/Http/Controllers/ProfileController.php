<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.main');
    }

    public function cpassword(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('current_password')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('current_password'),
                ]);
            } elseif ($errors->has('new_password')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('new_password'),
                ]);
            } elseif ($errors->has('confirm_password')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('confirm_password'),
                ]);
            }
        }

        $profile = User::find(auth()->user()->id);
        $profile->password = Hash::make($request->new_password);
        $profile->update();
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah',
        ]);
    }
}
