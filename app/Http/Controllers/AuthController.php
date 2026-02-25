<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request, AuthService $authService)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return $authService->login($request);
    }

    public function register(Request $request)
    {
        $request->validate([
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

        'department_id' => 'required_if:user_type,teacher,student_teacher|exists:departments,id',
        'employee_number' => 'required_if:user_type,teacher,student_teacher|unique:teachers',
         ]);

        return $authService->register($request);
    }

    public function logout(Request $request, AuthService $authService){

        $authService->logout($request);
    }
}
