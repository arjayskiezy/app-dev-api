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
        'user_type' => 'required|in:student,faculty,student_faculty',

        'fname' => 'required|string|max:50',
        'mname' => 'nullable|string|max:50',
        'lname' => 'required|string|max:50',
        'gender' => 'required|in:male,female',
        'birthday' => 'nullable|date',

        'student_number' => 'required_if:user_type,student,student_faculty|unique:students',

        'department_id' => 'required_if:user_type,faculty,student_faculty|exists:departments,id',
        'employee_number' => 'required_if:user_type,faculty,student_faculty|unique:faculties',
]);

        return $authService->register($request);
    }
}
