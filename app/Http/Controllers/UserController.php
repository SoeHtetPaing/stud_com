<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\Department;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AnnouncementNoti;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home() {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $adminNo = User::where("role", "Admin")->count();
        $lecturerNo = User::where("role", "Lecturer")->count();
        // $studentNo = User::Nowhere("role", "Student")->count();
        $studentNo = User::where("role", "!=", "Admin")->where("role", "!=", "Lecturer")->count();

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


        //lecturer
        $deptLecturer = User::where("department", $user->department)->count();
        $today = Carbon::parse(Carbon::now())->format('l');
        // dd($today);
        $lttt = Timetable::where("day", $today)->where("lecturer_name", $user->name)->join("departments", "timetables.department_id", "=", "departments.id")->select("timetables.*", "departments.name as dept_name")->get();
        // dd($ttt);


        //student
        $sttt = Timetable::where("day", $today)->where("department_id", $user->department)->join("departments", "timetables.department_id", "=", "departments.id")->select("timetables.*", "departments.name as dept_name")->get();

        $data = AnnouncementNoti::where("audience_id", $user->id)->join("announcements", "announcement_notis.announce_id", "=", "announcements.id")->join("users", "announcements.announcer_id", "=", "users.id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*", "announcement_notis.*")->orderBy('announcements.updated_at', 'desc')->paginate(2);

        // dd($data);

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
        else if ($user->role == "Lecturer") { return view("lecturer.home", [
            "user"=> $user,
            "dept"=> $dept,
            "deptLecturer" => $deptLecturer,
            "totLecturer" => $lecturerNo,
            "totStudent" => $studentNo,
            "lttt" => $lttt,
            "data" => $data
        ]); }
        else { return view("student.home", [
            "user"=> $user,
            "dept"=> $dept,
            "deptLecturer" => $deptLecturer,
            "totStudent" => $studentNo,
            "sttt" => $sttt,
            "data" => $data
        ]); }
    }

    public function chat($back) {
        // dd($back);
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        return view("user.chat", ["user"=> $user, "dept"=> $dept, "back" => $back]);
    }

    public function manageProfile () {
        $user = Auth::user();

        return view('user.profile', [
            "user" => $user,
        ]);
    }

    public function viewAnnounce ($id) {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        // dd($id);
        AnnouncementNoti::where("id", $id)->update(["is_seen" => 1]);
        $data = AnnouncementNoti::where("announcement_notis.id", $id)->join("announcements", "announcement_notis.announce_id", "=", "announcements.id")->join("users", "announcements.announcer_id", "=", "users.id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*", "announcement_notis.*")->first();

        return view('user.viewAnnounce', compact('user', 'dept', 'data'));
    }

}
