<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\Department;
use App\Models\GroupMember;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementNoti;
use App\Models\GroupConversation;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupConversationNoti;
use Illuminate\Support\Facades\Storage;

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
        $name = $req["lecturer"][0];
        $subject_id = $req["subject"][0];
        // dd($email);

        $subject = Subject::where("id", $subject_id)->first();

        // dd($subject["subject_name"]);
        Timetable::create(["department_id" => $req["year"], "section" => $req["section"], "day" => $req["day"], "start_hour" => $req["startHour"], "end_hour" => $req["endHour"], "subject_code" => $subject["subject_code"], "subject_name" => $subject["subject_name"], "lecturer_name" => $name]);

        return redirect()->back()->with("message", "New session is successfully added to timetable.");

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

    public function createLecturerGroup (Request $req) {
        // dd($req);
        if($req->hasFile("groupImage")) {
            $image = $req->file("groupImage")->getClientOriginalName();
            // dd($image);
            $req->file("groupImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        Group::create(["name" => $req["groupName"], "type" => "mul2mul", "creater_id" => Auth::user()->id, "image" => $image]);
        $group_id = Group::count();

        GroupMember::create(["group_id" => $group_id, "user_id" => Auth::user()->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $group_id, "user_id" => $member]);
            }
        }

        return redirect()->back()->with("message", "Group name \"".$req["groupName"]."\" is successfully created.");
    }

    public function createStudentGroup (Request $req) {
        // dd($req);
        if($req->hasFile("groupImage")) {
            $image = $req->file("groupImage")->getClientOriginalName();
            // dd($image);
            $req->file("groupImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        Group::create(["name" => $req["groupName"], "type" => "mul2mul", "creater_id" => Auth::user()->id, "image" => $image]);
        $group_id = Group::count();

        GroupMember::create(["group_id" => $group_id, "user_id" => Auth::user()->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $group_id, "user_id" => $member]);
            }
        }

        return redirect()->back()->with("message", "Group name \"".$req["groupName"]."\" is successfully created.");
    }

    public function createCustomGroup (Request $req) {
        // dd($req);
        if($req->hasFile("groupImage")) {
            $image = $req->file("groupImage")->getClientOriginalName();
            // dd($image);
            $req->file("groupImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
        }

        Group::create(["name" => $req["groupName"], "type" => "mul2mul", "creater_id" => Auth::user()->id, "image" => $image]);
        $group_id = Group::count();

        GroupMember::create(["group_id" => $group_id, "user_id" => Auth::user()->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $group_id, "user_id" => $member]);
            }
        }

        return redirect()->back()->with("message", "Group name \"".$req["groupName"]."\" is successfully created.");
    }


    public function addSubject (Request $req) {

        $is_exist = Subject::where("subject_code", $req["subjectCode"])->where("term", $req["term"])->where("subject_name", $req["subjectName"])->first();
        $department = Department::where("id", $req["year"])->first();

        if($is_exist == null) {
            Subject::create(["subject_code" => $req["subjectCode"], "subject_name" => $req["subjectName"], "term" => $req["term"], "department_id" => $req["year"]]);

            return redirect()->to("http://127.0.0.1:8000/dashboard#studentTwo")->with("message", $req["subjectCode"]." ".$req["subjectName"]." is successfully added for ".$department["name"]." → ".$req["term"].".");;

        } else {
            return redirect()->back()->with("error", $req["subjectCode"]." ".$req["subjectName"]." is already added for ".$department["name"]." → ".$req["term"]."!");
        }

    }

    public function addSubjectInTimetable (Request $req) {

        $is_exist = Subject::where("subject_code", $req["subjectCode"])->where("term", $req["term"])->where("subject_name", $req["subjectName"])->first();
        $department = Department::where("id", $req["year"])->first();

        if($is_exist == null) {
            Subject::create(["subject_code" => $req["subjectCode"], "subject_name" => $req["subjectName"], "term" => $req["term"], "department_id" => $req["year"]]);

            return redirect()->back()->with("message", $req["subjectCode"]." ".$req["subjectName"]." is successfully added for ".$department["name"]." → ".$req["term"].".");;

        } else {
            return redirect()->back()->with("error", $req["subjectCode"]." ".$req["subjectName"]." is already added for ".$department["name"]." → ".$req["term"]."!");
        }

    }

    public function announceGrade (Request $req) {
        // dd($req);
        if($req->hasFile("gradeFile")) {
            $file = $req->file("gradeFile")->getClientOriginalName();
            // dd($file);
            $req->file("gradeFile")->storeAs("public/upload", $file);
        } else {
            return redirect()->back()->with("error", "Empty grade file!");
        }

        $group_name = "gStu" . Auth::user()->id . "bless" . $req["member"][0];
        // echo $group_name;
        $group_name_rev = "gStu" . $req["member"][0] . "bless" . Auth::user()->id;
        // echo $group_name_rev;

        $group_exist = Group::orWhere("name", "$group_name")->orWhere("name", "$group_name_rev")->first();
        // dd($group_exist);

        if($group_exist == null) {
            Group::create(["name" => $group_name, "type" => "sig2sig", "creater_id" => Auth::user()->id, "image" => null]);
            $group_id = Group::count();

            GroupMember::create(["group_id" => $group_id, "user_id" => Auth::user()->id]);

            $members = $req["member"];
            if($members != null) {
                foreach ($members as $member) {
                    GroupMember::create(["group_id" => $group_id, "user_id" => $member]);
                    $member_id = GroupMember::count();
                    GroupConversation::create(["group_id" => $group_id, "member_id" => $member_id, "message" => $req["message"], "attachment" => $file]);
                    $conversation_id = GroupConversation::count();
                    GroupConversationNoti::create(["conversation_id" => $conversation_id, "audience_id" => $member, "is_seen" => false]);
                }
            }

            return redirect()->back()->with("message", "Grade is successfully sent.");
        } else {
            $members = $req["member"];
            if($members != null) {
                foreach ($members as $member) {
                    $member_id = GroupMember::where("group_id", $group_exist["id"])->where("user_id", $member)->first();
                    // dd($member_id);

                    GroupConversation::create(["group_id" => $group_exist["id"], "member_id" => $member_id["id"], "message" => $req["message"], "attachment" => $file]);
                    $conversation_id = GroupConversation::count();
                    GroupConversationNoti::create(["conversation_id" => $conversation_id, "audience_id" => $member, "is_seen" => false]);
                }
            }

            return redirect()->back()->with("message", "Grade is successfully sent.");
        }

    }


    //vertical sidebar
    public function manageAnnounce () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%');
        })->orderBy('announcements.created_at', 'desc')->paginate(2);

        return view('admin.announce', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data
        ]);
    }

    public function deleteAnnounce ($id) {
        AnnouncementNoti::where('announce_id', $id)->delete();
        Announcement::where('id', $id)->delete();

        return redirect()->back()->with("error", "Announcement is successfully deleted.");
    }

    public function showAnnounce ($id) {
        // $data = Announcement::where('id', $id)->first();
        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->where('announcements.id', $id)->first();


        return view('admin.showAnnounce', compact('data'));
    }

    public function editAnnounce ($id) {
        // $data = Announcement::where('id', $id)->first();
        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->where('announcements.id', $id)->first();
        // dd($data);


        return view('admin.editAnnounce', compact('data'));
    }

    public function updateAnnouncePhoto (Request $req) {
        // dd($req);
        $announce_id = $req['announce_id'];
        // dd($data_id);

        $action = $req['submit'];
        // dd($action);

        if($action == "Remove") {
            $temp = Announcement::where("id", $announce_id)->first();
            // dd($temp);
            $old_img = $temp['image'];
            // dd($old_img);

            Storage::delete('public/upload/'.$old_img);
            Announcement::where("id", $announce_id)->update(["image" => null]);

            return redirect()->back()->with("message", "Announce photo is successfully removed.");

        } else {
            if($req->hasFile("annoImage")) {
                $image = $req->file("annoImage")->getClientOriginalName();
                // dd($image);

                $temp = Announcement::where("id", $announce_id)->first();
                // dd($temp);
                $old_img = $temp['image'];
                // dd($old_img);

                Storage::delete('public/upload/'.$old_img);
                $req->file("annoImage")->storeAs("public/upload", $image);

                Announcement::where("id", $announce_id)->update(["image" => $image]);

                return redirect()->back()->with("message", "Announce photo is successfully updated.");
            } else {
                return redirect()->back()->with("error", "Error! Image is null.");
            }
        }

    }

    public function updateAnnounce (Request $req) {
        // dd($req);
        if($req->hasFile("annoImage")) {
            $image = $req->file("annoImage")->getClientOriginalName();
            // dd($image);
            $req->file("annoImage")->storeAs("public/upload", $image);
        } else {
            $image = null;
            // dd($image);
        }

        if ($image == null) {
            Announcement::where("id", $req["announce_id"])->update(["title" => $req["annoTitle"], "content" => $req["annoContent"]]);

        } else {
            Announcement::where("id", $req["announce_id"])->update(["title" => $req["annoTitle"], "content" => $req["annoContent"], "image" => $image]);

        }

        return redirect()->back()->with("message", "Announcement is successfully updated.");
    }

    public function manageUser () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = User::join("departments", "users.department", "=", "departments.id")->select("users.*", "departments.name as dept_name")->when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('users.name', 'like', '%'.$key.'%')->orWhere('users.email', 'like', '%'.$key.'%')->orWhere('users.role', 'like', '%'.$key.'%')->orWhere('departments.name', 'like', '%'.$key.'%')->orWhere('users.gendar', 'like', $key)->orWhere('users.section', 'like', '%'.$key.'%');
        })->orderBy('updated_at', 'desc')->paginate(4);

        return view('admin.user', [
            "user" => $user,
            "dept" => $dept,
            "lectDept" => Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get(),
            "stuDept" => Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get(),
            "data" => $data
        ]);
    }

    public function deleteUser ($id) {
        // dd($id);
        User::where('id', $id)->delete();

        return redirect()->back()->with("error", "User is successfully deleted.");
    }

    public function editUser ($id) {
        // dd($id);
        // $data = User::where('id', $id)->first();
        $data = User::join("departments", "users.department", "=", "departments.id")->select("users.*", "departments.id as dept_id", "departments.name as dept_name")->where('users.id', $id)->first();

        if($data['section'] == "") {
            $dept = Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        } else {
            $dept = Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        }

        // dd($data);


        return view('admin.editUser', compact('data', 'dept'));
    }

    public function updateUser (Request $req) {
        // dd($req);
        $action = $req["submit"];
        if($action == "Reset") {
            // dd($action);

            $user = User::where("id", $req["user_id"])->first();

            switch ($user->role) {
                case 'Admin':
                    $password = password_hash("admin@ucsp", PASSWORD_DEFAULT);
                    break;

                case 'Lecturer':
                    $password = password_hash("lecturer@ucsp", PASSWORD_DEFAULT);
                    break;

                default:
                    $password = password_hash("student@ucsp", PASSWORD_DEFAULT);
                    break;
            }

            // dd($req["user_id"]." ".$password);

            User::where("id", $req['user_id'])->update(["password" => $password]);
            return redirect()->back()->with("message", "Password is successfully reseted.");

        } else {
            // dd($action);
            // dd($req);

            if(isset($req["section"])) {
                // dd("section");
                User::where("id", $req["user_id"])->update(["name" => $req["name"], "email" => $req["email"], "role" => $req["role"], "department" => $req["dept"], "section" => $req["section"], "gendar" => $req["gendar"]]);

            } else {
                // dd("no section");
                User::where("id", $req["user_id"])->update(["name" => $req["name"], "email" => $req["email"], "role" => $req["role"], "department" => $req["dept"], "gendar" => $req["gendar"]]);
            }

            return redirect()->route("admin@manageUser")->with("message", "User info is successfully updated.");


        }

    }


    public function manageTimetable () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        $subject = Subject::all();
        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        // $data = Timetable::all()->groupBy("department_id");
        $data = Timetable::join("departments", "timetables.department_id", "=", "departments.id")->select("timetables.*", "departments.name")->when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%');
        })->get()->groupBy("name");

        // dd($data->toArray());

        return view('admin.timetable', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "stuDept" => Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get(),
            "subject" => $subject,
            "lecturer" => $lecturer

        ]);
    }

    public function manageDepartment () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo", "users.email", "announcements.*")->when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%');
        })->orderBy('announcements.created_at', 'desc')->paginate(2);

        $data = $data->toArray();

        return view('admin.department', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data
        ]);
    }

    public function manageGroup () {
        return view('admin.group');
    }

    public function manageGrade () {
        return view('admin.grade');
    }

    public function manageProfile () {
        return view('admin.profile');
    }

}
