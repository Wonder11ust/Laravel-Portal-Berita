<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Auth::user();
        return response()->json([
            'status'=>200,
            'account'=>$account
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Data User',
            'account'=>$user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            'status'=>200,
            'account'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'=>'required|max:255',
            'password'=>'nullable'
        ];

        if($request->name != $user->name)
        {
            $rules['name']='required|unique:users';
        }
        if($request->email != $user->email)
        {
            $rules['email']='required|unique:users|email';
        }

        $validatedData = $request->validate($rules);

        $user->update($validatedData);

        return response()->json([
            'status'=>200,
            'message'=>'Akun berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
