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
        $this->validate($request, [
            'name'=> '',
            'email'=> '',
            'password'=> '',
            ]);

        $user = DB::table('users')->insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> hash($request->password),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {  
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

    }
}
