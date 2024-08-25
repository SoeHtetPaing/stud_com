<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Timetable;
use App\Models\Department;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    public function timetable () {
        $user = Auth::user();
        $dept = Department::where("id", $user->department)->first();

        $tt = array();

        $mon = Timetable::where("day", "Monday")->where("lecturer_name", $user->name)->get();
        $tt ["mon"] = $mon->toArray();

        $tue = Timetable::where("day", "Tueday")->where("lecturer_name", $user->name)->get();
        $tt["tue"] = $tue->toArray();

        $wed = Timetable::where("day", "Wednesday")->where("lecturer_name", $user->name)->get();
        $tt["wed"] = $wed->toArray();

        $thu = Timetable::where("day", "Thurday")->where("lecturer_name", $user->name)->get();
        $tt["thu"] = $thu->toArray();

        $fri = Timetable::where("day", "Friday")->where("lecturer_name", $user->name)->get();
        $tt["fri"] = $fri->toArray();

        $tte = Timetable::where("lecturer_name", $user->name)->join("departments", "timetables.department_id", "=", "departments.id")->select('subject_code', 'subject_name', 'name', 'section')->distinct()->orderBy("subject_code")->get();

        // dd($tt);

        return view('lecturer.timetable', [
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

        return view('lecturer.department', [
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



        return view('lecturer.group', [
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

        return view('lecturer.editGroup', compact('data', 'member', 'custom'));
    }

    public function updateGroup (Request $req) {
        // dd($req);

        Group::where("id", $req["groupId"])->update(["name" => $req["groupName"]]);

        return redirect()->route("lecturer@editGroup", ["id" => $req["groupId"]])->with("message", "Group name is successfully updated.");

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

        return redirect()->route('lecturer@editGroup', $req['groupId'])->with(["msg" => $msg, "errors" => $errors]);

    }
}
