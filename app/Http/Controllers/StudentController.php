<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function setting() {
        return view("student.setting");
    }

    public function chat() {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        return view("student.chat", ["user"=> $user, "dept"=> $dept]);
    }
}
