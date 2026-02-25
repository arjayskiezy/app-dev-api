<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    public function login (Request $request){

        $user = User::where("email", $request->email)->first();
 
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                "title" => "Authentication Failed",
                "message" => "The provided credentials are incorrect"
            ], 401);   
        }
        
        $user = User::with(['student','teacher'])->find($user->id);

        $token =$user->createToken('token', ['*'])->plainTextToken;

        return response([
            "user"=> $user,
            "token"=>$token
        ]);
    }

    public function register(array $data)
    {
        DB::beginTransaction();

        try {
            $user = new User();
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            if ($data['user_type'] === 'student'|| $data['user_type'] === 'student_teacher') {
                Student::create([
                    'user_id' => $user->id,
                    'fname' => $data['fname'],
                    'mname' => $data['mname'] ?? null,
                    'lname' => $data['lname'],
                    'gender'=> $data['gender'],
                    'student_number' => $data['student_number'],
                    'birthday' => $data['birthday'] ?? null,
                ]);
            } 
            if ($data['user_type'] === 'teacher'|| $data['user_type'] === 'student_teacher'){
                Teacher::create([
                    'user_id' => $user->id,
                    'department_id' => $data['department_id'],
                    'fname' => $data['fname'],
                    'mname' => $data['mname'] ?? null,
                    'lname' => $data['lname'],
                    'gender'=> $data['gender'],
                    'employee_number' => $data['employee_number'],
                    'birthday' => $data['birthday'] ?? null,
                ]);
            }

            DB::commit();

            $user = User::with(['student','teacher'])->find($user->id);

            return response([
                'title' => 'Registration Successful',
                'user' => $user,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                "title"=> "Registration Failed",
                "message"=> "An unexpected error occurred while registering the user.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response(204);

    }

}