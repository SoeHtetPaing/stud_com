<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home() {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $adminNo = User::where("role", "Admin")->count();
        $lecturerNo = User::where("role", "Lecturer")->count();
        $studentNo = User::where("role", "Student")->count();

        if ($user->role == "Admin") { return view("admin.home", [
            "user" => $user,
            "dept" => $dept,
            "adminNo" => $adminNo,
            "lecturerNo" => $lecturerNo,
            "studentNo" => $studentNo,
            "lectDept" => Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get(),
            "stuDept" => Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get(),
        ]); }
        if ($user->role == "Lecturer") { return view("lecturer.home", ["user"=> $user, "dept"=> $dept]); }
        if ($user->role == "Student") { return view("student.home", ["user"=> $user, "dept"=> $dept]); }
    }

    public function chat() {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        return view("chat.home", ["user"=> $user, "dept"=> $dept]);
    }
}
