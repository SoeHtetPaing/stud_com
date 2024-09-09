<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\ChatConfig;
use App\Models\Department;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AnnouncementNoti;
use App\Models\GroupConversation;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupConversationNoti;
use Symfony\Component\HttpKernel\Attribute\Cache;

class UserController extends Controller
{
    public function home() {

        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        // dd($_COOKIE);

        $adminNo = User::where("role", "Admin")->count();
        $lecturerNo = User::where("role", "Lecturer")->count();
        // $studentNo = User::Nowhere("role", "Student")->count();
        $studentNo = User::where("role", "!=", "Admin")->where("role", "!=", "Lecturer")->count();

        $lecturer = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->orWhere("users.role", "Lecturer")->orWhere("users.role", "Admin")->get();
        $student = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->where("users.role", "!=", "Admin")->where("users.role", "!=", "Lecturer")->get();
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

        User::where("id", $user->id)->update(["status" => "Busy"]);
        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");


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

            "subject" => $subject,
            "chatNoti" => $chatNoti

        ]); }
        else if ($user->role == "Lecturer") { return view("lecturer.home", [
            "user"=> $user,
            "dept"=> $dept,
            "deptLecturer" => $deptLecturer,
            "totLecturer" => $lecturerNo,
            "totStudent" => $studentNo,
            "lttt" => $lttt,
            "data" => $data,
            "chatNoti" => $chatNoti
        ]); }
        else { return view("student.home", [
            "user"=> $user,
            "dept"=> $dept,
            "deptLecturer" => $deptLecturer,
            "totStudent" => $studentNo,
            "sttt" => $sttt,
            "data" => $data,
            "chatNoti" => $chatNoti
        ]); }
    }

    public function chat($back) {
        // dd($back);
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        User::where("id", $user->id)->update(["status" => "Online"]);

        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();


        $newNoti = AnnouncementNoti::where("audience_id", $user->id)->where("is_seen", 0)
        ->join("announcements", "announcements.id", "=", "announcement_notis.announce_id")
        ->select(
            "announcements.id as aid", "announcement_notis.id as anid",
            "announcements.title as atitle", "announcements.content as acontent",
            "announcements.announcer_id as announcer", "announcement_notis.audience_id as audience", "announcement_notis.is_seen as seen",
        )
        ->orderBy("announcements.created_at")
        ->get();
        // dd($newNoti);

        // my-group-info
        $mygroup = GroupMember::where("group_members.user_id", $user->id)
        ->join("groups", function($jg) {
            $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "=", "mul2mul");
        })
        ->join("users", "users.id", "=", "group_members.user_id")
        ->join("departments", "departments.id", "=", "users.department")
        ->join("chat_configs", function($jc) {
            $jc->on("chat_configs.group_id", "=", "groups.id")->on("chat_configs.user_id", "=", "users.id");
        })
        ->select(
            "users.id as uid", "groups.id as gid", "group_members.id as mid",
            "groups.name as gname", "groups.image as gimage", "groups.type as gtype","groups.creater_id as gcid",
            "users.name as uname", "users.email as uemail", "users.profile_photo_path as uimage", "users.role as urole", "users.gendar as usex", "users.section as usection",
            "departments.name as dname", "departments.id as did",
            "chat_configs.mynew", "chat_configs.yrnew", "chat_configs.is_active as active_group", "chat_configs.lat",
        )
        ->orderBy("chat_configs.lat", "desc")
        ->get();
        // dd($mygroup);

        // my-chat-info
        $mychat = GroupMember::where("group_members.user_id", $user->id)
        ->join("groups", function($jg) {
            $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "!=", "mul2mul");
        })
        ->join("users", "users.id", "=", "group_members.user_id")
        ->join("departments", "departments.id", "=", "users.department")
        ->join("chat_configs", function($jc) {
            $jc->on("chat_configs.group_id", "=", "groups.id")->on("chat_configs.user_id", "=", "users.id");
        })
        ->select(
            "users.id as uid", "groups.id as gid", "group_members.id as mid",
            "groups.name as gname", "groups.mygn", "groups.yrgn", "groups.image as gimage", "groups.mygimg", "groups.yrgimg", "groups.type as gtype", "groups.myid", "groups.yrid", "groups.creater_id as gcid",
            "users.name as uname", "users.email as uemail", "users.profile_photo_path as uimage", "users.role as urole", "users.gendar as usex", "users.section as usection",
            "departments.name as dname", "departments.id as did",
            "chat_configs.mynew", "chat_configs.yrnew", "chat_configs.is_active as active_group", "chat_configs.lat",
        )
        ->orderBy("chat_configs.lat", "desc")
        ->get();
        // dd($myanno);

        //active chat
        $ac = ChatConfig::where("user_id", $user->id)->where("is_active", 1)->first();
        if ($ac != null) {
            ChatConfig::where('id', $ac->id)->update(["yrnew" => 0 ]);

            $ag = GroupMember::where("group_id", $ac->group_id)->where("user_id", $user->id)
            ->join("groups", "groups.id", "=", "group_members.group_id")
            ->select(
                "group_members.user_id as uid", "group_members.id as mid",
                "groups.id as gid", "groups.name", "groups.mygn", "groups.yrgn", "groups.type", "groups.image", "groups.mygimg", "groups.yrgimg",  "groups.myid", "groups.yrid", "groups.creater_id",
            )
            ->first();
            $agc = GroupConversation::where("group_id", $ag->gid)->orderBy("updated_at", "desc")->get();

            $myinfo = User::where('id', $ag->myid)->first();
            $yrinfo = User::where('id', $ag->yrid)->first();

            // $cg = GroupMember::where("user_id", $ag->creater_id)
            // ->join("groups", function ($jg) {
            //     $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "mul2mul");
            // })
            // ->select(
            //     "group_members.user_id as uid", "group_members.id as mid",
            //     "groups.id as gid", "groups.name", "groups.mygn", "groups.yrgn", "groups.type", "groups.image", "groups.mygimg", "groups.yrgimg",  "groups.myid", "groups.yrid", "groups.creater_id",
            // )
            // ->orderBy("groups.created_at", "desc")
            // ->get();

            $gm = GroupMember::where("group_id", $ag->gid)
            ->join("users", "users.id", "=", "group_members.user_id")
            ->select(
                "group_members.user_id as uid", "group_members.id as mid",
                "users.name as uname", "users.email as uemail", "users.profile_photo_path as uimage", "users.role as urole", "users.gendar as usex", "users.section as usection",
            )
            ->get();

            $mypg = GroupMember::where("user_id", $ag->myid)
            ->join("groups", function ($jg) {
                $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "mul2mul");
            })
            ->select(
                "group_members.user_id as uid", "group_members.id as mid",
                "groups.id as gid", "groups.name", "groups.mygn", "groups.yrgn", "groups.type", "groups.image", "groups.mygimg", "groups.yrgimg",  "groups.myid", "groups.yrid", "groups.creater_id",
            )
            ->orderBy("groups.created_at", "desc")
            ->get();

            $yrpg = GroupMember::where("user_id", $ag->yrid)
            ->join("groups", function ($jg) {
                $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "mul2mul");
            })
            ->select(
                "group_members.user_id as uid", "group_members.id as mid",
                "groups.id as gid", "groups.name", "groups.mygn", "groups.yrgn", "groups.type", "groups.image", "groups.mygimg", "groups.yrgimg",  "groups.myid", "groups.yrid", "groups.creater_id",
            )
            ->orderBy("groups.created_at", "desc")
            ->get();

        } else {
            $ac = null;
            $ag = null;
            $agc = [];
            $myinfo = null;
            $yrinfo = null;

            // $cg = [];
            $gm = [];
            $mypg = [];
            $yrpg = [];
        }
        // dd($ag);




        $newChat = GroupConversationNoti::where("audience_id", $user->id)->where("is_seen", 0)
        ->join("group_conversations", "group_conversations.id", "=", "group_conversation_notis.conversation_id")
        ->join("groups", function($jg) {
            $jg->on("groups.id", "=", "group_conversations.group_id");
        })
        ->join("users", "users.id", "=", "group_conversation_notis.audience_id")
        ->join("departments", "departments.id", "=", "users.department")
        ->select(
            "users.id as uid", "groups.id as gid", "group_conversations.member_id as mid","group_conversations.id as gcid", "group_conversation_notis.id as gcnid",
            "groups.name as gname", "groups.image as gimage", "groups.type as gtype","groups.creater_id as gcid",
            "group_conversations.message as gcmessage", "group_conversations.attachment as gcfile",
            "users.name as uname", "users.email as uemail", "users.profile_photo_path as uimage", "users.role as urole", "users.gendar as usex", "users.section as usection",
            "departments.name as dname", "departments.id as did",
            "group_conversation_notis.audience_id as audience", "group_conversation_notis.is_seen as seen", "group_conversation_notis.created_at as created_at", "group_conversation_notis.updated_at as updated_at",
        )
        ->orderBy("group_conversation_notis.created_at")
        ->get();
        // dd($newChat);

        return view("user.chat", [
            "user"=> $user,
            "dept"=> $dept,
            "back" => $back,
            "newNoti" => $newNoti,
            "custom" => $custom,
            "mygroup" => $mygroup,
            "mychat" => $mychat,
            "ac" => $ac,
            "ag" => $ag,
            "agc" => $agc,
            "myinfo" => $myinfo,
            "yrinfo" => $yrinfo,

            // "cg" => $cg,
            "gm" => $gm,
            "mypg" => $mypg,
            "yrpg" => $yrpg
        ]);
    }

    public function startChat (Request $req) {
        // dd($req);
        $my = Auth::user();
        // dd($my);
        $yr = User::where('id', $req['member'][0])->first();
        // dd($yr);


        $group_name = "gStu" . $my->id . "bless" . $req["member"][0];
        // echo $group_name;
        $group_name_rev = "gStu" . $req["member"][0] . "bless" . $my->id;
        // echo $group_name_rev;

        $group_exist = Group::orWhere("name", "$group_name")->orWhere("name", "$group_name_rev")->first();
        // dd($group_exist);

        if($group_exist == null) {
            Group::create(["name" => $group_name, "mygn" => $yr->name, "yrgn" => $my->name, "type" => "sig2sig", "creater_id" => $my->id, "image" => null, "mygimg" => $yr->profile_photo_path, "yrgimg" => $my->profile_photo_path, "myid" => $my->id, "yrid" => $yr->id]);
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

            return redirect()->back();
        } else {

            ChatConfig::where("user_id", $my->id)->where("is_active", 1)->update(["is_active" => 0]);
            ChatConfig::where("user_id", $my->id)->where("group_id", $group_exist["id"])->update(["is_active" => 1, "lat" => Carbon::now()]);

            $members = $req["member"];
            if($members != null) {
                foreach ($members as $member) {

                    $cc = ChatConfig::where("group_id", $group_exist["id"])->where("user_id", $member)->first();
                    ChatConfig::where("user_id", $member)->where("is_active", 1)->update(["is_active" => 0]);
                    $no_of_new = $cc->yrnew + 1;
                    ChatConfig::where("user_id", $member)->where("group_id", $group_exist["id"])->update(["yrnew" => $no_of_new, "is_active" => 1, "lat" => Carbon::now()]);

                }
            }

            return redirect()->back();
        }


    }

    public function sendMessage(Request $req) {
        // dd($req);
        $member = GroupMember::where("group_id", $req["gid"])->where("id", "!=", $req["mid"])->get();
        ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
        ChatConfig::where("user_id", Auth::user()->id)->where("group_id", $req["gid"])->update(["is_active" => 1, "lat" => Carbon::now()]);
        // dd($member);

        GroupConversation::create(["group_id" => $req["gid"], "member_id" => $req["mid"], "message" => $req["message"]]);
        $last_c = GroupConversation::all()->last();

        foreach ($member as $m) {
            GroupConversationNoti::create(["conversation_id" => $last_c->id, "audience_id" => $m->user_id, "is_seen" => false]);

            $cc = ChatConfig::where("group_id", $req["gid"])->where("user_id", $m->user_id)->first();
            // dd($cc);
            ChatConfig::where("user_id", $m->user_id)->where("is_active", 1)->update(["is_active" => 0]);
            $no_of_new = $cc->yrnew + 1;
            ChatConfig::where("user_id", $m->user_id)->where("group_id", $req["gid"])->update(["yrnew" => $no_of_new, "is_active" => 1, "lat" => Carbon::now()]);

        }

        return redirect()->back();

    }

    public function sendMessageWithPhoto (Request $req) {
        // dd($req);

        if($req->hasFile("msgImage")) {
            $file = $req->file("msgImage")->getClientOriginalName();
            $unique = uniqid();
            $unique_file = $unique."-iQ-".$file;
            // dd($unique_file);

            $extension = pathinfo($file,PATHINFO_EXTENSION);
            // dd($extension);

			if ($extension =="jpg" || $extension =="png" || $extension =="jpeg"){

                $req->file("msgImage")->storeAs("public/upload", $unique_file);

                $member = GroupMember::where("group_id", $req["gid"])->where("id", "!=", $req["mid"])->get();
                ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
                ChatConfig::where("user_id", Auth::user()->id)->where("group_id", $req["gid"])->update(["is_active" => 1, "lat" => Carbon::now()]);
                // dd($member);

                GroupConversation::create(["group_id" => $req["gid"], "member_id" => $req["mid"], "message" => $req["message"], "attachment" => $unique_file]);
                $last_c = GroupConversation::all()->last();

                foreach ($member as $m) {
                    GroupConversationNoti::create(["conversation_id" => $last_c->id, "audience_id" => $m->user_id, "is_seen" => false]);

                    $cc = ChatConfig::where("group_id", $req["gid"])->where("user_id", $m->user_id)->first();
                    // dd($cc);
                    ChatConfig::where("user_id", $m->user_id)->where("is_active", 1)->update(["is_active" => 0]);
                    $no_of_new = $cc->yrnew + 1;
                    ChatConfig::where("user_id", $m->user_id)->where("group_id", $req["gid"])->update(["yrnew" => $no_of_new, "is_active" => 1, "lat" => Carbon::now()]);

                }

                return redirect()->back();

			}else{

                return redirect()->back()->with("error", "Required JPG,PNG,JPEG!");
			}

        } else {
            return redirect()->back()->with("error", "Empty photo!");
        }
    }

    public function sendMessageWithFile (Request $req) {
        // dd($req);

        if($req->hasFile("msgFile")) {
            $file = $req->file("msgFile")->getClientOriginalName();
            $unique = uniqid();
            $unique_file = $unique."-iQ-".$file;
            // dd($unique_file);

            $extension = pathinfo($file,PATHINFO_EXTENSION);
            // dd($extension);

			if ($extension =="jpg" || $extension =="png" || $extension =="jpeg"){

                return redirect()->back()->with("error", "JPG,PNG,JPEG are not allowed!");

			}else{

                $req->file("msgFile")->storeAs("public/upload", $unique_file);

                $member = GroupMember::where("group_id", $req["gid"])->where("id", "!=", $req["mid"])->get();
                ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
                ChatConfig::where("user_id", Auth::user()->id)->where("group_id", $req["gid"])->update(["is_active" => 1, "lat" => Carbon::now()]);
                // dd($member);

                GroupConversation::create(["group_id" => $req["gid"], "member_id" => $req["mid"], "message" => $req["message"], "attachment" => $unique_file]);
                $last_c = GroupConversation::all()->last();

                foreach ($member as $m) {
                    GroupConversationNoti::create(["conversation_id" => $last_c->id, "audience_id" => $m->user_id, "is_seen" => false]);

                    $cc = ChatConfig::where("group_id", $req["gid"])->where("user_id", $m->user_id)->first();
                    // dd($cc);
                    ChatConfig::where("user_id", $m->user_id)->where("is_active", 1)->update(["is_active" => 0]);
                    $no_of_new = $cc->yrnew + 1;
                    ChatConfig::where("user_id", $m->user_id)->where("group_id", $req["gid"])->update(["yrnew" => $no_of_new, "is_active" => 1, "lat" => Carbon::now()]);

                }

                return redirect()->back();

			}

        } else {
            return redirect()->back()->with("error", "Empty file!");
        }
    }


    public function selectChat($id) {
        // dd($id);
        ChatConfig::where("user_id", Auth::user()->id)->where("is_active", 1)->update(["is_active" => 0]);
        ChatConfig::where("group_id", $id)->where("user_id", Auth::user()->id)->update(["is_active" => 1, "yrnew" => 0]);

        return redirect()->back();

    }

    public function manageProfile () {
        $user = Auth::user();

        User::where("id", $user->id)->update(["status" => "Busy"]);

        $chatNoti = ChatConfig::where("user_id", $user->id)->sum("yrnew");
        // dd($chatNoti);

        return view('user.profile', [
            "user" => $user,
            "chatNoti" => $chatNoti
        ]);
    }

    public function viewAnnounce ($id) {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();
        // dd($id);
        User::where("id", $user->id)->update(["status" => "Busy"]);

        AnnouncementNoti::where("id", $id)->update(["is_seen" => 1]);
        $data = AnnouncementNoti::where("announcement_notis.id", $id)->join("announcements", "announcement_notis.announce_id", "=", "announcements.id")->join("users", "announcements.announcer_id", "=", "users.id")->select("users.name", "users.role", "users.profile_photo_path", "users.email", "announcements.*", "announcement_notis.*")->first();

        return view('user.viewAnnounce', compact('user', 'dept', 'data'));
    }

    public function logout() {
        User::where("id", Auth::user()->id)->update(["status" => "Offline"]);

        Auth::logout();
        return redirect('login');

    }

}
