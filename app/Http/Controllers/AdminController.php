<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementNoti;
use App\Models\Department;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function addAnnouncement (Request $req) {

        if($req->hasFile("annoImage")) {
            $image = $req->file("annoImage")->getClientOriginalName();
            // dd($image);
            $req->file("annoImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        Announcement::create(["title" => $req["annoTitle"], "content" => $req["annoContent"], "announcer_id" => Auth::user()->id, "image" => $image]);
        $anno_id = Announcement::count();

        $audience = User::where("role", "!=", "admin")->get();
        foreach ($audience as $data) {
            AnnouncementNoti::create(["announce_id" => $anno_id, "audience_id" => $data->id, "is_seen" => false]);
        }

        return redirect()->back()->with("message", "New announcement is successfully added.");

    }

    public function addAdmin (Request $req) {
        $user_valid = User::where("email", $req["adminEmail"])->first();

        if($user_valid == null) {
            return redirect()->back()->with("error", "Invalid email address!");
        } else {
            User::where("id", $user_valid["id"])->update(["name" => $user_valid["name"], "email" => $user_valid["email"], "role" => "Admin", "department" => $user_valid["department"], "section" => $user_valid["section"], "gendar" => $user_valid["gendar"], "password" => $user_valid["password"], "profile_photo" => $user_valid["profile_photo"]]);

            return redirect()->back()->with("message", "Now, you updated as ".$user_valid["name"]." is changed to admin.");
        }
    }

    public function addLecturer (Request $req) {

        // dd($req);
        if($req->hasFile("lectImage")) {
            $image = $req->file("lectImage")->getClientOriginalName();
            // dd($image);
            $req->file("lectImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        User::create(["name" => $req["lectName"], "email" => $req["lectEmail"], "role" => "Lecturer", "department" => $req["dept"], "section" => null, "gendar" => $req["gendar"], "password" => $req["lectPassword"], "profile_photo" => $image]);

        return redirect()->back()->with("message", "New lecturer is successfully added.");
    }

    public function addStudent (Request $req) {

        // dd($req);
        if($req->hasFile("stuImage")) {
            $image = $req->file("stuImage")->getClientOriginalName();
            // dd($image);
            $req->file("stuImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        User::create(["name" => $req["stuName"], "email" => $req["stuEmail"], "role" => "Student", "department" => $req["dept"], "section" => $req["section"], "gendar" => $req["gendar"], "password" => $req["stuPassword"], "profile_photo" => $image]);

        return redirect()->back()->with("message", "New student is successfully added.");
    }

    public function addTimetable (Request $req) {
        $email = $req["lectEmail"];

        $lecturer = User::where("email", $email)->first();

        if($lecturer != null) {
            if($lecturer["role"] == "Lecturer") {
                Timetable::create(["department_id" => $req["year"], "section" => $req["section"], "day" => $req["day"], "start_hour" => $req["startHour"], "end_hour" => $req["endHour"], "subject_code" => $req["subjectCode"], "subject_name" => $req["subjectName"], "lecturer_name" => $lecturer["name"]]);

                return redirect()->back()->with("message", "New session is successfully added to timetable.");
            } else {
                return redirect()->back()->with("error", "Email is not lecturer mail!");
            }

        } else {
            return redirect()->back()->with("error", "No lecturer found!");
        }

    }

    public function addDepartment (Request $req) {
        $department = Department::where("name", $req["deptName"])->first();

        if($department == null) {
            Department::create(["name" => $req["deptName"]]);

            return redirect()->back()->with("message", "New department is successfully added.");
        } else {
            return redirect()->back()->with("error", $req["deptName"]." is already existed!");
        }

    }
}
