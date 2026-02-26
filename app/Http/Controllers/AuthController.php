<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'title' => 'Authentication Failed',
                'message' => 'The provided credentials are incorrect',
            ], 401);
        }

        $user = User::with(['student', 'teacher'])->find($user->id);

        $token = $user->createToken('token', ['*'], now()->plus(weeks: 1))->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'remember' => 'boolean',
            'user_type' => 'required|in:student,teacher,student_teacher',

            'fname' => 'required|string|max:50',
            'mname' => 'nullable|string|max:50',
            'lname' => 'required|string|max:50',
            'gender' => 'required|in:male,female',
            'birthday' => 'nullable|date',

            'student_number' => 'required_if:user_type,student,student_teacher|unique:students',
            'year_level' => 'required_if:user_type,student,student_teacher|unique:students',

            'department_id' => 'required_if:user_type,teacher,student_teacher|exists:departments,id',
            'employee_number' => 'required_if:user_type,teacher,student_teacher|unique:teachers',
        ]);
        
        DB::beginTransaction();

        try {
            $user = new User;
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            if ($data['user_type'] === 'student' || $data['user_type'] === 'student_teacher') {
                Student::create([
                    'user_id' => $user->id,
                    'fname' => $data['fname'],
                    'mname' => $data['mname'] ?? null,
                    'lname' => $data['lname'],
                    'gender' => $data['gender'],
                    'student_number' => $data['student_number'],
                    'year_level' => $data['year_level'],
                    'birthday' => $data['birthday'] ?? null,
                ]);
            }
            if ($data['user_type'] === 'teacher' || $data['user_type'] === 'student_teacher') {
                Teacher::create([
                    'user_id' => $user->id,
                    'department_id' => $data['department_id'],
                    'fname' => $data['fname'],
                    'mname' => $data['mname'] ?? null,
                    'lname' => $data['lname'],
                    'gender' => $data['gender'],
                    'employee_number' => $data['employee_number'],
                    'birthday' => $data['birthday'] ?? null,
                ]);
            }

            DB::commit();

            $user = User::with(['student', 'teacher'])->find($user->id);

            return response([
                'title' => 'Registration Successful',
                'user' => $user,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response([
                'title' => 'Registration Failed',
                'message' => 'An unexpected error occurred while registering the user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(204);
    }

    public function update(Request $request){
        $request->user()->currentAccessToken()->update([]);
    }
}
