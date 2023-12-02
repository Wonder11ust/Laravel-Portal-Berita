<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        User::destroy($user->id);
        return response()->json([
            'status'=>200,
            'message'=>"User Berhasil Dihapus"
        ]);
    }

    

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed'],
    ]);

    // Periksa apakah current_password yang dimasukkan sesuai dengan password saat ini
    if (!Hash::check($request->current_password, $request->user()->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Password saat ini tidak valid.',
        ], 400);
    }

    // Update password
    $request->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Password berhasil diperbarui.',
    ], 200);
}
}
