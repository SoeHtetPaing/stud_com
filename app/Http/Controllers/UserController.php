<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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

        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();
        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "Student")->get();
        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();

        $totalSubject = Subject::distinct("subject_code")->count();

        $t1y1cs = Subject::where("term", "First Term CS")->where("department_id", 1)->orderBy("subject_code", "desc")->get();
        $t1y2cs = Subject::where("term", "First Term CS")->where("department_id", 2)->orderBy("subject_code", "desc")->get();
        $t1y2ct = Subject::where("term", "First Term CT")->where("department_id", 2)->orderBy("subject_code", "desc")->get();
        $t1y3cs = Subject::where("term", "First Term CS")->where("department_id", 3)->orderBy("subject_code", "desc")->get();
        $t1y3ct = Subject::where("term", "First Term CT")->where("department_id", 3)->orderBy("subject_code", "desc")->get();
        $t1y4cs = Subject::where("term", "First Term CS")->where("department_id", 4)->orderBy("subject_code", "desc")->get();
        $t1y4ct = Subject::where("term", "First Term CT")->where("department_id", 4)->orderBy("subject_code", "desc")->get();
        $t1y5cs = Subject::where("term", "First Term CS")->where("department_id", 5)->orderBy("subject_code", "desc")->get();
        $t1y5ct = Subject::where("term", "First Term CT")->where("department_id", 5)->orderBy("subject_code", "desc")->get();


        $t2y1cs = Subject::where("term", "Second Term CS")->where("department_id", 1)->orderBy("subject_code", "desc")->get();
        $t2y2cs = Subject::where("term", "Second Term CS")->where("department_id", 2)->orderBy("subject_code", "desc")->get();
        $t2y2ct = Subject::where("term", "Second Term CT")->where("department_id", 2)->orderBy("subject_code", "desc")->get();
        $t2y3cs = Subject::where("term", "Second Term CS")->where("department_id", 3)->orderBy("subject_code", "desc")->get();
        $t2y3ct = Subject::where("term", "Second Term CT")->where("department_id", 3)->orderBy("subject_code", "desc")->get();
        $t2y4cs = Subject::where("term", "Second Term CS")->where("department_id", 4)->orderBy("subject_code", "desc")->get();
        $t2y4ct = Subject::where("term", "Second Term CT")->where("department_id", 4)->orderBy("subject_code", "desc")->get();
        $t2y5cs = Subject::where("term", "Second Term CS")->where("department_id", 5)->orderBy("subject_code", "desc")->get();
        $t2y5ct = Subject::where("term", "Second Term CT")->where("department_id", 5)->orderBy("subject_code", "desc")->get();

        $subject = Subject::all();


        // dd($t1y1cs);

        if ($user->role == "Admin") { return view("admin.home", [
            "user" => $user,
            "dept" => $dept,
            "adminNo" => $adminNo,
            "lecturerNo" => $lecturerNo,
            "studentNo" => $studentNo,
            "lectDept" => Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get(),
            "stuDept" => Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get(),
            "lecturer" => $lecturer,
            "student" => $student,
            "custom" => $custom,

            "totalSubject" => $totalSubject,

            "t1y1cs" => $t1y1cs,
            "t1y2cs" => $t1y2cs,
            "t1y2ct" => $t1y2ct,
            "t1y3cs" => $t1y3cs,
            "t1y3ct" => $t1y3ct,
            "t1y4cs" => $t1y4cs,
            "t1y4ct" => $t1y4ct,
            "t1y5cs" => $t1y5cs,
            "t1y5ct" => $t1y5cs,

            "t2y1cs" => $t2y1cs,
            "t2y2cs" => $t2y2cs,
            "t2y2ct" => $t2y2ct,
            "t2y3cs" => $t2y3cs,
            "t2y3ct" => $t2y3ct,
            "t2y4cs" => $t2y4cs,
            "t2y4ct" => $t2y4ct,
            "t2y5cs" => $t2y5cs,
            "t2y5ct" => $t2y5cs,

            "subject" => $subject

        ]); }
        else if ($user->role == "Lecturer") { return view("lecturer.home", ["user"=> $user, "dept"=> $dept]); }
        else { return view("student.home", ["user"=> $user, "dept"=> $dept]); }
    }

    public function chat($back) {
        // dd($back);
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        return view("chat.home", ["user"=> $user, "dept"=> $dept, "back" => $back]);
    }
}
