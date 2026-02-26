<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index() 
    {  
        $users = DB::table('users')->orderBy('id')->get();
         return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {  
        $request->validate([
            'id' => 'required|exist:users_id',
            'password'=> 'required|string|min:6|confirmed',
            ]);

        $user = User::find($request->id);

        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'status'=> 'success',
            'message'=> 'Password updated successfully'
            ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

    }
}
