<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // get roles
        $studentRole = Role::where('name', 'student')->first();
        $facultyRole = Role::where('name', 'faculty')->first();
        $adminRole = Role::where('name', 'admin')->first();

        // Create 10 random users
        User::factory(10)->create()->each(function ($user) use ($studentRole, $facultyRole) {

            // randomly decide if user is student or faculty
            $isStudent = rand(0,1) === 1;

            if ($isStudent) {
                // assign role
                $user->assignRole($studentRole);

                // create student profile
                Student::create([
                    'user_id' => $user->id,
                    'fname' => $user->name, 
                    'lname' => 'Student',
                    'student_number' => '2024-' . rand(1000,9999),
                    'birthday' => '2004-01-01',
                ]);
            } else {
                // assign role
                $user->assignRole($facultyRole);

                // create faculty profile
                Faculty::create([
                    'user_id' => $user->id,
                    'department_id' => 1,
                    'fname' => $user->name,
                    'lname' => 'Faculty',
                    'employee_number' => 'EMP-' . rand(100,999),
                    'birthday' => '1990-01-01',
                ]);
            }
        });

        // Create a admin user
        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
        ]);

        $admin->assignRole('admin');
        Faculty::create([
            'user_id' => $admin->id,
            'department_id' => 1,
            'fname' => $admin->name,
            'lname' => 'Admin',
            'employee_number' => 'EMP-001',
            'birthday' => '1985-01-01',
        ]);
    }
}