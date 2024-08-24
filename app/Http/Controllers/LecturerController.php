<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function timetable () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        $subject = Subject::all();
        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        // $data = Timetable::all()->groupBy("department_id");
        // $data = Timetable::join("departments", "timetables.department_id", "=", "departments.id")->select("timetables.*", "departments.name")->when(request('key'), function ($p) {
        //     $key = request('key');
        //     $p->orWhere('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%');
        // })->get()->groupBy("name")->groupBy("section");
        // $data = $data->toArray();
        // dd($data);

        $y1s1 = Timetable::where("department_id", 1)->where("section", "Section A")->get()->toArray();
        $y1s2 = Timetable::where("department_id", 1)->where("section", "Section B")->get()->toArray();
        $y1s3 = Timetable::where("department_id", 1)->where("section", "Section C")->get()->toArray();

        $y2s1 = Timetable::where("department_id", 2)->where("section", "Section A")->get()->toArray();
        $y2s2 = Timetable::where("department_id", 2)->where("section", "Section B")->get()->toArray();
        $y2s3 = Timetable::where("department_id", 2)->where("section", "Section CT")->get()->toArray();

        $y3s1 = Timetable::where("department_id", 3)->where("section", "Section A")->get()->toArray();
        $y3s2 = Timetable::where("department_id", 3)->where("section", "Section B")->get()->toArray();
        $y3s3 = Timetable::where("department_id", 3)->where("section", "Section CT")->get()->toArray();

        $y4s1 = Timetable::where("department_id", 4)->where("section", "Section A")->get()->toArray();
        $y4s2 = Timetable::where("department_id", 4)->where("section", "Section B")->get()->toArray();
        $y4s3 = Timetable::where("department_id", 4)->where("section", "Section CT")->get()->toArray();

        $y5s1 = Timetable::where("department_id", 5)->where("section", "Section A")->get()->toArray();
        $y5s2 = Timetable::where("department_id", 5)->where("section", "Section B")->get()->toArray();
        $y5s3 = Timetable::where("department_id", 5)->where("section", "Section CT")->get()->toArray();

        // dd(count($y5s2));


        return view('lecturer.timetable', [
            "user" => $user,
            "dept" => $dept,
            // "data" => $data,
            "stuDept" => Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get(),
            "subject" => $subject,
            "lecturer" => $lecturer,
            "y1s1" => $y1s1,
            "y1s2" => $y1s2,
            "y1s3" => $y1s3,

            "y2s1" => $y2s1,
            "y2s2" => $y2s2,
            "y2s3" => $y2s3,

            "y3s1" => $y3s1,
            "y3s2" => $y3s2,
            "y3s3" => $y3s3,

            "y4s1" => $y4s1,
            "y4s2" => $y4s2,
            "y4s3" => $y4s3,

            "y5s1" => $y5s1,
            "y5s2" => $y5s2,
            "y5s3" => $y5s3,

        ]);
    }

    public function department () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = Department::when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('name', 'like', '%'.$key.'%');
        })->orderBy('updated_at', 'desc')->paginate(6);


        return view('lecturer.department', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data
        ]);
    }

    public function group () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();
        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "Student")->get();
        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();


        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = Group::where("type", "mul2mul")->join("users", "groups.creater_id", "=", "users.id")->select("groups.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->when(request('key'), function ($p) {
            $key = request('key');
            $p->where('groups.name', 'like', '%'.$key.'%');
        })->orderBy('groups.updated_at', 'desc')->paginate(4);

        // dd($data);


        return view('lecturer.group', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "lecturer" => $lecturer,
            "student" => $student,
            "custom" => $custom
        ]);
    }
}
