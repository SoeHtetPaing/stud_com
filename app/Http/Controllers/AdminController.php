<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\ChatConfig;
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
        $last = Announcement::all()->last();

        $audience = User::where("role", "!=", "admin")->get();
        foreach ($audience as $data) {
            AnnouncementNoti::create(["announce_id" => $last->id, "audience_id" => $data->id, "is_seen" => false]);
        }

        return redirect()->back()->with("message", "New announcement is successfully added.");

    }

    public function addAdmin (Request $req) {
        $user_valid = User::where("email", $req["adminEmail"])->first();

        if($user_valid == null) {
            return redirect()->back()->with("error", "Invalid email address!");
        } else {
            User::where("id", $user_valid["id"])->update(["role" => "Admin"]);

            return redirect()->back()->with("message", "Now, you updated as ".$user_valid["name"]." is changed to admin.");
        }
    }

    public function addLecturer (Request $req) {

        // dd($req);
        if($req->hasFile("lectImage")) {
            $image = $req->file("lectImage")->getClientOriginalName();
            $unique = uniqid();
            $save_image = $unique."iQ".$image;
            $save_image_path = "profile-photos/".$save_image;
            // dd($save_image_path);
            $req->file("lectImage")->storeAs("public/profile-photos", $save_image);
        } else {
            $save_image_path = null;
        }

        // dd($save_image_path);

        User::create(["name" => $req["lectName"], "email" => $req["lectEmail"], "phone" => $req["phone"],"role" => "Lecturer", "department" => $req["dept"], "section" => "NA", "gendar" => $req["gendar"], "address" => $req["address"], "password" => $req["lectPassword"], "profile_photo_path" => $save_image_path, "status" => "Offline"]);

        return redirect()->back()->with("message", "New lecturer is successfully added.");
    }

    public function addStudent (Request $req) {

        // dd($req);
        if($req->hasFile("stuImage")) {
            $image = $req->file("stuImage")->getClientOriginalName();
            $unique = uniqid();
            $save_image = $unique."iQ".$image;
            $save_image_path = "profile-photos/".$save_image;
            // // dd($save_image_path);

            $req->file("stuImage")->storeAs("public/profile-photos", $save_image);
        } else {
            $save_image_path = null;
        }

        // dd($save_image_path);

        User::create(["name" => $req["stuName"], "email" => $req["stuEmail"], "phone" => $req["phone"], "role" => "Student", "department" => $req["dept"], "section" => $req["section"], "gendar" => $req["gendar"], "address" => $req["address"], "password" => $req["stuPassword"], "profile_photo_path" => $save_image_path, "status" => "Offline"]);

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
        $last = Group::all()->last();

        GroupMember::create(["group_id" => $last->id, "user_id" => Auth::user()->id]);
        ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
        ChatConfig::create(["user_id" => Auth::user()->id, "mynew" => 0, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $last->id, "user_id" => $member]);
                ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                ChatConfig::create(["user_id" => $member, "yrnew" => 1, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);
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
        $last = Group::all()->last();

        GroupMember::create(["group_id" => $last->id, "user_id" => Auth::user()->id]);
        ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
        ChatConfig::create(["user_id" => Auth::user()->id, "mynew" => 0, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $last->id, "user_id" => $member]);
                ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                ChatConfig::create(["user_id" => $member, "yrnew" => 1, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);
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
        $last = Group::all()->last();

        GroupMember::create(["group_id" => $last->id, "user_id" => Auth::user()->id]);
        ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
        ChatConfig::create(["user_id" => Auth::user()->id, "mynew" => 0, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);

        $members = $req["member"];
        if($members != null) {
            foreach ($members as $member) {
                GroupMember::create(["group_id" => $last->id, "user_id" => $member]);
                ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                ChatConfig::create(["user_id" => $member, "yrnew" => 1, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);
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
        $my = Auth::user();
        // dd($my);
        $yr = User::where('id', $req['member'][0])->first();
        // dd($yr);


        if($req->hasFile("gradeFile")) {
            $file = $req->file("gradeFile")->getClientOriginalName();
            $unique = uniqid();
            $unique_file = $unique."-iQ-".$file;
            // dd($unique_file);

            // dd($file);
            $req->file("gradeFile")->storeAs("public/upload", $unique_file);
        } else {
            return redirect()->back()->with("error", "Empty grade file!");
        }

        $group_name = "gStu" . $my->id . "bless" . $req["member"][0];
        // echo $group_name;
        $group_name_rev = "gStu" . $req["member"][0] . "bless" . $my->id;
        // echo $group_name_rev;

        $group_exist = Group::orWhere("name", "$group_name")->orWhere("name", "$group_name_rev")->first();
        // dd($group_exist);

        if($group_exist == null) {
            Group::create(["name" => $group_name, "mygn" => $yr->name, "yrgn" => $my->name, "type" => "grade2announce", "creater_id" => $my->id, "image" => null, "mygimg" => $yr->profile_photo_path, "myid" => $my->id, "yrid" => $yr->id, "yrgimg" => $my->profile_photo_path]);
            $last = Group::all()->last();

            GroupMember::create(["group_id" => $last->id, "user_id" => Auth::user()->id]);
            $last_m = GroupMember::all()->last();

            ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
            ChatConfig::create(["user_id" => Auth::user()->id, "mynew" => 0, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);

            GroupConversation::create(["group_id" => $last->id, "member_id" => $last_m->id, "message" => $req["message"], "attachment" => $unique_file, "grade_announce" => 1]);
            $last_c = GroupConversation::all()->last();

            $members = $req["member"];
            if($members != null) {
                foreach ($members as $member) {
                    GroupMember::create(["group_id" => $last->id, "user_id" => $member]);
                    ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                    ChatConfig::create(["user_id" => $member, "yrnew" => 1, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $last->id]);

                    GroupConversationNoti::create(["conversation_id" => $last_c->id, "audience_id" => $member, "is_seen" => false]);
                }
            }

            return redirect()->back()->with("message", "Grade is successfully sent.");
        } else {
            $mymid = GroupMember::where("group_id", $group_exist["id"])->where("user_id", $my->id)->first();
            ChatConfig::where("user_id", $my->id)->where("is_active", 1)->update(["is_active" => 0]);
            ChatConfig::where("user_id", $my->id)->where("group_id", $group_exist["id"])->update(["is_active" => 1, "lat" => Carbon::now()]);


            GroupConversation::create(["group_id" => $group_exist["id"], "member_id" => $mymid["id"], "message" => $req["message"], "attachment" => $unique_file, "grade_announce" => 1]);
            $last_c = GroupConversation::all()->last();

            $members = $req["member"];
            if($members != null) {
                foreach ($members as $member) {
                    $member_id = GroupMember::where("group_id", $group_exist["id"])->where("user_id", $member)->first();
                    // dd($member_id);
                    $cc = ChatConfig::where("group_id", $group_exist["id"])->where("user_id", $member)->first();
                    ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                    $no_of_new = $cc->yrnew + 1;
                    ChatConfig::where("user_id", $member)->where("group_id", $group_exist["id"])->update(["yrnew" => $no_of_new, "is_active" => 1, "lat" => Carbon::now()]);

                    GroupConversationNoti::create(["conversation_id" => $last_c->id, "audience_id" => $member, "is_seen" => false]);
                }
            }

            return redirect()->back()->with("message", "Grade is successfully sent.");
        }

    }


    //vertical sidebar
    public function manageAnnounce () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%');
        })->orderBy('announcements.updated_at', 'desc')->paginate(2);

        return view('admin.announce', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteAnnounce ($id) {

        $announce = Announcement::where('id', $id)->first();
        $old_img = $announce['image'];
        // dd($old_img);
        Storage::delete('public/upload/'.$old_img);

        AnnouncementNoti::where('announce_id', $id)->delete();
        Announcement::where('id', $id)->delete();

        return redirect()->back()->with("error", "Announcement is successfully deleted.");
    }

    public function showAnnounce ($id) {
        // $data = Announcement::where('id', $id)->first();
        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->where('announcements.id', $id)->first();


        return view('admin.showAnnounce', compact('data'));
    }

    public function editAnnounce ($id) {
        // $data = Announcement::where('id', $id)->first();
        $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->where('announcements.id', $id)->first();
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

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
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
            "data" => $data,
            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteUser ($id) {
        // dd($id);
        $user = User::where('id', $id)->first();
        $old_img = $user['profile_photo_path'];
        // dd($old_img);
        Storage::delete('public/profile-photos/'.$old_img);

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

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

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


        return view('admin.timetable', [
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

            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteAllTimetable () {
        // dd("delete all");
        Timetable::truncate();

        return redirect()->back()->with("error", "Timetables in this semister are all cleared! Let start up for next semister schedule.");
    }

    public function deleteTimetable ($id) {
        // dd($id);
        Timetable::where('id', $id)->delete();

        return redirect()->back()->with("error", "A timetable schedule is successfully deleted.");
    }

    public function editTimetable ($id) {
        // dd($id);
        $data = Timetable::where('id', $id)->first();
        $subject = Subject::all();
        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();
        $stuDept = Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year"])->get();


        // $data = User::join("departments", "users.department", "=", "departments.id")->select("users.*", "departments.id as dept_id", "departments.name as dept_name")->where('users.id', $id)->first();

        // if($data['section'] == "") {
        //     $dept = Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        // } else {
        //     $dept = Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        // }

        // dd($data);

        return view('admin.editTimetable', compact('data', 'stuDept', 'subject', 'lecturer'));
    }

    public function updateTimetable (Request $req) {
        // dd($req);

        $name = $req["lecturer"][0];
        $subject_id = $req["subject"][0];
        // dd($email);

        $subject = Subject::where("id", $subject_id)->first();

        // dd($subject["subject_name"]);
        Timetable::where("id", $req["tid"])->update(["department_id" => $req["year"], "section" => $req["section"], "day" => $req["day"], "start_hour" => $req["startHour"], "end_hour" => $req["endHour"], "subject_code" => $subject["subject_code"], "subject_name" => $subject["subject_name"], "lecturer_name" => $name]);

        return redirect()->route("admin@manageTimetable")->with("message", "A timetable schedule is successfully updated.");

    }

    public function manageDepartment () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = Department::when(request('key'), function ($p) {
            $key = request('key');
            $p->orWhere('name', 'like', '%'.$key.'%');
        })->orderBy('updated_at', 'desc')->paginate(6);


        return view('admin.department', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteDepartment ($id) {
        // dd($id);
        $dept = Department::where('id', $id)->first();
        Department::where('id', $id)->delete();

        return redirect()->back()->with("error", "Department name '".$dept->name."' is successfully deleted.");
    }

    public function editDepartment ($id) {
        // dd($id);
        $data = Department::where('id', $id)->first();

        // $data = User::join("departments", "users.department", "=", "departments.id")->select("users.*", "departments.id as dept_id", "departments.name as dept_name")->where('users.id', $id)->first();

        // if($data['section'] == "") {
        //     $dept = Department::whereNotIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        // } else {
        //     $dept = Department::whereIn("name", ["First Year", "Second Year", "Third Year", "Fourth Year", "Final Year", "Granduate"])->get();
        // }

        // dd($data);

        return view('admin.editDepartment', compact('data'));
    }

    public function updateDepartment (Request $req) {
        // dd($req);
        $show_id = $req["deptShowId"];

        Department::where("id", $req["deptId"])->update(["name" => $req["deptName"]]);

        return redirect()->route("admin@manageDepartment")->with("message", "Department '".$show_id."' is successfully updated.");

    }

    public function manageGroup () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();
        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "!=", "Admin")->where("users.role", "!=", "Lecturer")->get();
        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();


        // $data = Announcement::orderBy("created_at", "desc")->paginate(1);
        // $data = User::join("announcements", "users.id", "=", "announcements.announcer_id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*")->orderBy("announcements.created_at", "desc")->paginate(2);
        // dd($data);

        $data = Group::where("type", "mul2mul")->join("users", "groups.creater_id", "=", "users.id")->select("groups.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->when(request('key'), function ($p) {
            $key = request('key');
            $p->where('groups.name', 'like', '%'.$key.'%');
        })->orderBy('groups.updated_at', 'desc')->paginate(4);

        // dd($data);


        return view('admin.group', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "lecturer" => $lecturer,
            "student" => $student,
            "custom" => $custom,
            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteGroup ($id) {
        // dd($id);
        $group = Group::where('id', $id)->first();

        $old_img = $group['image'];
        // dd($old_img);
        Storage::delete('public/upload/'.$old_img);

        $convert = GroupConversation::where('group_id', $group->id)->get();
        foreach ($convert as $value) {
            GroupConversationNoti::where("conversation_id", $value->id)->delete();
        }
        GroupConversation::where("group_id", $id)->delete();
        GroupMember::where("group_id", $id)->delete();
        Group::where('id', $id)->delete();

        return redirect()->back()->with("error", "Group '".$group->name."' is successfully deleted.");
    }

    public function editGroup ($id) {
        // dd($id);

        $data = Group::where("groups.id", $id)->join("users", "groups.creater_id", "=", "users.id")->select("groups.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->first();
        $member = GroupMember::where("group_id", $id)->join("users", "group_members.user_id", "=", "users.id")->select("group_members.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->get();
        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();

        // dd($member);

        return view('admin.editGroup', compact('data', 'member', 'custom'));
    }

    public function updateGroup (Request $req) {
        // dd($req);

        Group::where("id", $req["groupId"])->update(["name" => $req["groupName"]]);

        return redirect()->route("admin@editGroup", ["id" => $req["groupId"]])->with("message", "Group name is successfully updated.");

    }

    public function removeMember ($id) {
        // dd($id);
        $temp = GroupMember::where('id', $id)->first();
        $member = User::where('id', $temp->user_id)->first();
        // dd($temp);
        $convert = GroupConversation::where('group_id', $temp->group_id)->where('member_id', $temp->id)->get();
        foreach ($convert as $value) {
            GroupConversationNoti::where("conversation_id", $value->id)->delete();
        }
        GroupMember::where('id', $id)->delete();
        ChatConfig::where("user_id", $member->id)->where("group_id", $temp->group_id)->delete();


        return redirect()->back()->with("error", "Member '".$member->name."' is successfully removed from this group.");
    }

    public function addMember (Request $req) {
        // dd($req);
        $members = $req["member"];
        $msg = [];
        $errors = [];
        if($members != null) {
            foreach ($members as $member) {
                $member_exist = GroupMember::where('group_id', $req["groupId"])->where('user_id', $member)->first();
                // dd($member_exist);
                if($member_exist == null) {
                    GroupMember::create(["group_id" => $req["groupId"], "user_id" => $member]);
                    ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                    ChatConfig::create(["user_id" => $member, "yrnew" => 1, "is_active" => 1, "lat" => Carbon::now(), "creater_id" => Auth::user()->id, "group_id" => $req['groupId']]);

                    $user = User::where('id', $member)->first();
                    array_push($msg, $user->name." is successfully enrolled in this group.");
                } else {
                    $user = User::where('id', $member_exist->user_id)->first();
                    array_push($errors, $user->name." is already memberized in this group!");
                }

            }
        }

        return redirect()->route('admin@editGroup', $req['groupId'])->with(["msg" => $msg, "errors" => $errors]);

    }

    public function updateGroupPhoto (Request $req) {
        // dd($req);
        $gid = $req['gid'];
        // dd($data_id);

        $action = $req['submit'];
        // dd($action);

        if($action == "Remove") {
            $temp = Group::where("id", $gid)->first();
            // dd($temp);
            $old_img = $temp['image'];
            // dd($old_img);

            Storage::delete('public/upload/'.$old_img);
            Group::where("id", $gid)->update(["image" => null]);

            return redirect()->back()->with("message", "Group photo is successfully removed.");

        } else {
            if($req->hasFile("groupImage")) {
                $image = $req->file("groupImage")->getClientOriginalName();
                // dd($image);

                $temp = Group::where("id", $gid)->first();
                // dd($temp);
                $old_img = $temp['image'];
                // dd($old_img);

                Storage::delete('public/upload/'.$old_img);
                $req->file("groupImage")->storeAs("public/upload", $image);

                Group::where("id", $gid)->update(["image" => $image]);

                return redirect()->back()->with("message", "Group photo is successfully updated.");
            } else {
                return redirect()->back()->with("error", "Error! Image is null.");
            }
        }

    }



    public function manageGrade () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");

        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "!=", "Admin")->where("users.role", "!=", "Lecturer")->get();

        $data = Group::where('type', 'grade2announce')->join("group_conversations", function ($jgc) {
            $jgc->on("groups.id", "=", "group_conversations.group_id")->where("group_conversations.grade_announce", 1);
        })->join("users", "groups.creater_id", "=", "users.id")->select("group_conversations.*", "groups.name as group_name", "groups.type", "groups.creater_id", "users.name as creater_name")->when(request('key'), function ($p) {
            $key = request('key');
            $p->where('group_conversations.message', 'like', '%'.$key.'%');
        })->orderBy('group_conversations.created_at', 'desc')->paginate(10);

        // dd($data);


        return view('admin.grade', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "student" => $student,
            "chatNoti" => $chatNoti
        ]);
    }

    public function deleteGrade ($id) {
        // dd($id);
        $gc = GroupConversation::where('id', $id)->first();
        // dd($gc);

        $old_img = $gc['attachment'];
        // dd($old_img);
        Storage::delete('public/upload/'.$old_img);


        GroupConversationNoti::where("conversation_id", $id)->delete();
        GroupConversation::where("id", $id)->delete();

        return redirect()->back()->with("error", "Grade announcement is successfully deleted.");
    }

    public function editGrade ($id) {
        // dd($id);

        $data = GroupConversation::where('group_conversations.id', $id)->join("groups", "group_conversations.group_id", "=", "groups.id")->join("users", "groups.creater_id", "=", "users.id")->select("group_conversations.*", "groups.name as group_name", "groups.type", "groups.creater_id", "users.name as creater_name", "users.profile_photo_path")->first();
        // dd($data);
        $gm = GroupMember::where('id', $data->member_id)->first();
        $rc = User::where('id', $gm->user_id)->first();
        // dd($rc);

        return view('admin.editGrade', compact('data', 'rc'));
    }

    public function updateGradeFile (Request $req) {
        // dd($req);
        $cid = $req['cid'];

        if($req->hasFile("gradeFile")) {
            $file = $req->file("gradeFile")->getClientOriginalName();
            $unique = uniqid();
            $unique_file = $unique."-iQ-".$file;
            // dd($unique_file);

            $temp = GroupConversation::where("id", $cid)->first();
            // dd($temp);
            $old_file = $temp['attachment'];
            // dd($old_img);

            Storage::delete('public/upload/'.$old_file);
            // dd($file);
            $req->file("gradeFile")->storeAs("public/upload", $unique_file);

            GroupConversation::where("id", $cid)->update(["attachment" => $unique_file]);

            return redirect()->back()->with("message", "Grade file is successfully updated.");
        } else {
            return redirect()->back()->with("error", "Error! File is null.");
        }

    }

    public function updateGrade (Request $req) {
        // dd($req);
        $action = $req["submit"];
        $cid = $req["cid"];
        // dd($action);

        if($action == "Remove") {
            $temp = GroupConversation::where("id", $cid)->first();
            // dd($temp);
            $old_file = $temp['attachment'];
            // dd($old_img);

            Storage::delete('public/upload/'.$old_file);
            GroupConversation::where("id", $cid)->update(["attachment" => ""]);

            return redirect()->back()->with("message", "Grade file is successfully removed.");
        } else {
            //  dd($req);
            if($req->hasFile("attachment")) {
                $file = $req->file("attachment")->getClientOriginalName();
                $unique = uniqid();
                $unique_file = $unique."-iQ-".$file;
                // dd($unique_file);

                $req->file("attachment")->storeAs("public/upload", $unique_file);

                GroupConversation::where("id", $cid)->update(["message" => $req["message"], "attachment" => $unique_file]);

                return redirect()->back()->with("message", "Grade is successfully updated.");
            } else {
                GroupConversation::where("id", $cid)->update(["message" => $req["message"]]);

                return redirect()->back()->with("message", "Grade name is successfully updated.");
            }
        }

    }

}
