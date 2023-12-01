<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status'=>200,
            'message'=>'Data User',
            'users'=>$users,
        ],200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>['required','max:255','unique:users'],
            'email'=>['required','email','unique:users'],
            'password'=> ['required']
        ]);
        $validatedData['role_id'] = 3;
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        return response()->json([
            'status'=>200,
            'message'=>'Data Baru Berhasil Ditambahkan'
        ],200);
    }
}
