<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Timetable;
use App\Models\Department;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function timetable () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $tt = array();

        $mon = Timetable::where("day", "Monday")->where("department_id", $user->department)->where("section", $user->section)->get();
        $tt ["mon"] = $mon->toArray();

        $tue = Timetable::where("day", "Tueday")->where("department_id", $user->department)->where("section", $user->section)->get();
        $tt["tue"] = $tue->toArray();

        $wed = Timetable::where("day", "Wednesday")->where("department_id", $user->department)->where("section", $user->section)->get();
        $tt["wed"] = $wed->toArray();

        $thu = Timetable::where("day", "Thurday")->where("department_id", $user->department)->where("section", $user->section)->get();
        $tt["thu"] = $thu->toArray();

        $fri = Timetable::where("day", "Friday")->where("department_id", $user->department)->where("section", $user->section)->get();
        $tt["fri"] = $fri->toArray();

        $tte = Timetable::where("department_id", $user->department)->where("section", $user->section)->select('subject_code', 'subject_name', 'lecturer_name')->distinct()->orderBy("subject_code")->get();


        // dd($tte);

        return view('student.timetable', [
            "user" => $user,
            "dept" => $dept,
            "tt" => $tt,
            "tte" => $tte
        ]);
    }


    public function department () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $member = User::where("department", $dept->id)->get();
        // dd($member);

        return view('student.department', [
            "user" => $user,
            "dept" => $dept,
            "member" => $member
        ]);
    }


    public function group () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();

        $data = Group::where("type", "mul2mul")->where("creater_id", $user->id)->join("users", "groups.creater_id", "=", "users.id")->select("groups.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->when(request('key'), function ($p) {
            $key = request('key');
            $p->where('groups.name', 'like', '%'.$key.'%');
        })->orderBy('groups.updated_at', 'desc')->paginate(4);

        return view('student.group', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
            "custom" => $custom
        ]);
    }

    public function editGroup ($id) {
        // dd($id);

        $data = Group::where("groups.id", $id)->join("users", "groups.creater_id", "=", "users.id")->select("groups.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->first();
        $member = GroupMember::where("group_id", $id)->join("users", "group_members.user_id", "=", "users.id")->select("group_members.*", "users.name as user_name", "users.email", "users.gendar", "users.profile_photo_path")->get();
        $custom = User::select("users.id as user_id", "users.name as user_name", "users.email as user_email", "departments.name as dept_name")->join("departments", "departments.id", "=", "users.department")->get();

        // dd($member);

        return view('student.editGroup', compact('data', 'member', 'custom'));
    }

    public function updateGroup (Request $req) {
        // dd($req);

        Group::where("id", $req["groupId"])->update(["name" => $req["groupName"]]);

        return redirect()->route("student@editGroup", ["id" => $req["groupId"]])->with("message", "Group name is successfully updated.");

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
                    $user = User::where('id', $member)->first();
                    array_push($msg, $user->name." is successfully enrolled in this group.");
                } else {
                    $user = User::where('id', $member_exist->user_id)->first();
                    array_push($errors, $user->name." is already memberized in this group!");
                }

            }
        }

        return redirect()->route('student@editGroup', $req['groupId'])->with(["msg" => $msg, "errors" => $errors]);

    }


    public function grade () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();


        $data = GroupMember::where("user_id", $user->id)
        ->join("groups", function($jg) {
            $jg->on("groups.id", "=", "group_members.group_id")->where("groups.type", "=", "grade2announce");
        })
        ->join("users", "users.id", "=", "groups.creater_id")
        ->join("departments", "departments.id", "=", "users.department")
        ->join("group_conversations", "group_conversations.group_id", "=", "groups.id")
        ->select(
            "users.id as uid", "groups.id as gid", "group_members.id as mid",
            "groups.name as gname", "groups.image as gimage", "groups.type as gtype","groups.creater_id as gcid",
            "users.name as uname", "users.email as uemail", "users.profile_photo_path as uimage", "users.role as urole", "users.gendar as usex", "users.section as usection",
            "departments.name as dname", "departments.id as did",
            "group_conversations.id as cid", "group_conversations.message as cmessage", "group_conversations.attachment as cfile", "group_conversations.created_at as created_at", "group_conversations.updated_at as updated_at",
        )->paginate(4);
        // dd($data);


        return view('student.grade', [
            "user" => $user,
            "dept" => $dept,
            "data" => $data,
        ]);
    }
}
