<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home() {
        $user = Auth::user();
        $dept = Department::where("id", $user->dept)->first();

        if ($user->role == "Admin") { return view("admin.home", ["user"=> $user, "dept"=> $dept]); }
        if ($user->role == "Lecturer") { return view("teacher.home", ["user"=> $user, "dept"=> $dept]); }
        if ($user->role == "Student") { return view("student.home", ["user"=> $user, "dept"=> $dept]); }
    }
}
