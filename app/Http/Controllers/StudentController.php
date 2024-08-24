<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function timetable () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();


        return view('student.timetable', [
            "user" => $user,
            "dept" => $dept

        ]);
    }


    public function manageDepartment () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();


        return view('student.department', [
            "user" => $user,
            "dept" => $dept,
        ]);
    }

    public function manageGroup () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        return view('student.group', [
            "user" => $user,
            "dept" => $dept,
        ]);
    }

    public function grade () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "Student")->get();

        $data = Group::where('type', 'grade2announce')->join("group_conversations", "groups.id", "=", "group_conversations.group_id")->join("users", "groups.creater_id", "=", "users.id")->select("group_conversations.*", "groups.name as group_name", "groups.type", "groups.creater_id", "users.name as creater_name")->when(request('key'), function ($p) {
            $key = request('key');
            $p->where('group_conversations.message', 'like', '%'.$key.'%');
        })->orderBy('group_conversations.created_at', 'desc')->paginate(10);

        // dd($data);


        return view('student.grade', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "student" => $student
        ]);
    }
}
