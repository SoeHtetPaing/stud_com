@extends('layouts.main-clone')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-admin" style="position: sticky; top: 0;">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image mt-1">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">(admin)</span></h>
                    </div>
                    <hr>
                    <div class="d-flex flex-column flex-shrink-0">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <h6 class="text-ucsp ps-1 d-none d-lg-inline" style="font-size: 14px;">General</h6>
                            <li class="nav-item">
                                <a href="{{route('user@home')}}" class="nav-link link-body-emphasis" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageAnnounce')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-megaphone"></i>
                                    <span class="d-none d-lg-inline ms-3">Announcement</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageUser')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-3">User</span>
                                </a>
                            </li>
                            <hr>
                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Managemant</h6>
                            <li class="nav-item">
                                <a href="{{route('admin@manageTimetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageDepartment')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageGroup')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="d-none d-lg-inline ms-3">Group</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageGrade')}}" class="nav-link active-vertical-menu">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            <hr>
                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Personal</h6>
                            <li class="d-none d-lg-inline">
                                <a href="{{route('user@manageProfile')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-gear-wide"></i>
                                    <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                </a>
                            </li>
                            <li class="d-none d-lg-inline">
                                <form action="{{route("logout")}}" method="post">
                                    @csrf
                                    <button type="submit" class="nav-link link-body-emphasis">
                                        <i class="bi bi-box-arrow-left"></i>
                                        <span class="d-none d-lg-inline ms-3">Log out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>

                        <div class="d-lg-none">
                            <div class="dropdown">
                                <a href="#"
                                    class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($user->profile_photo_path == null)
                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                    @else
                                    <img src="{{ url('storage/'.$user->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                                    @endif
                                </a>
                                <ul class="dropdown-menu text-small shadow">
                                    <li class="nav-item">
                                        <a href="{{route('user@manageProfile')}}" class="nav-link link-body-emphasis">
                                            <i class="bi bi-gear-wide"></i>
                                            <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{route("logout")}}" method="post">
                                            @csrf
                                            <button type="submit" class="nav-link link-body-emphasis">
                                                <i class="bi bi-box-arrow-left"></i>
                                                <span class="d-none d-lg-inline ms-3">Log out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- main content -->
            <div class="col-10 bg-light">
                <div class="horizontal-menu py-2 mt-1 d-flex justify-content-between bg-light" style="position: sticky; top: 0; z-index: 5;">
                    <div class="d-flex">

                    </div>
                    <div class="lg-profile d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="position-relative p-2">
                                <a href="{{route('user@chat', ['back' => 'admin@manageGrade'])}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message" style="top: 0.8rem; right: 0.4rem;"></span>
                                </a>
                            </div>
                        </div>
                        <div class="d-none d-lg-inline">
                            <div class="d-flex justify-content-center mt-1 ms-5">
                                <div class="profile-group position-relative">
                                    <h5 class="profile-title">{{Str::words(Str::after($user->name, 'Daw'), 5, '...')}}</h5>
                                    <p class="profile-role">{{Str::words(Str::after($dept->name, 'Department of'), 4, '...')}}</p>
                                </div>
                                <div class="ms-2">
                                    @if ($user->profile_photo_path == null)
                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                    @else
                                    <img src="{{ url('storage/'.$user->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-dark">

                    {{-- user content --}}
                    <div class="col-sm col-lg-8">

                        <div class="mb-3">
                            <div class="bg-white border rounded-pill">
                                <form action="{{route('admin@manageGrade')}}" method="get">
                                    <div class="input-group px-3 py-2">
                                        <input type="text" value="{{request('key')}}" name="key" class="search-input" placeholder="Search by notice message">
                                        <button class="search-btn" type="submit"><i class="fa fa-search text-ucsp"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mx-1"  style="height: 630px; overflow-y: scroll;">


                            <div class="tab-content py-3" id="tab-content">

                                @if (count($data) == 0)
                                    <div class="my-5 text-center">
                                        <div class="text-muted fs-5">
                                            Oop! No data found<br>
                                            <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                                        </div>
                                    </div>
                                 @else

                                 <div class="row">

                                    <div class="table-responsive p-0 rounded">
                                        <table class="table table-hover" style="width: 819px;">
                                            <tr>
                                                <th>Announce ID</th>
                                                <th>Announer</th>
                                                <th>Notice Message</th>
                                                <th>Grade File</th>
                                                <th></th>
                                            </tr>
                                    @foreach ($data as $r)

                                            <tr>
                                                <td>GD2ANO#{{$r["id"]."".$r["group_id"]."".$r["member_id"]}}</td>
                                                <td>{{$r->creater_name."@".$r->creater_id."#".$r->created_at->format('y.m.d')}}</td>
                                                <td>{{$r->message}}</td>
                                                <td>
                                                    @php
                                                        $type = Str::words(Str::after($r->attachment, '.'), 5);
                                                    @endphp
                                                    @if ($type == "pdf")
                                                        <a href="{{asset('storage/upload/'.$r->attachment.'')}}" class="text-decoration-none" style="font-size: 13px;"><i class="fa-regular fa-file-pdf fa-lg me-1"></i>Download</a>
                                                    @else
                                                        <a href="{{asset('storage/upload/'.$r->attachment.'')}}" class="text-decoration-none" style="font-size: 13px;"><i class="fa-regular fa-file-image fa-lg me-2"></i>View</a>

                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{route('admin@deleteGrade', $r['id'])}}" class="text-decoration-none">
                                                        <button class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>
                                                    </a>
                                                    <a href="{{route('admin@editGrade', $r['id'])}}" class="text-decoration-none">
                                                        <button class="btn btn-sm btn-outline-ucsp"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </td>
                                            </tr>


                                    @endforeach
                                        </table>
                                    </div>
                                    {{$data->appends(request()->query())->links()}}
                                 </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-sm col-lg-4 bg-white"  style="position: sticky; top: 65px; z-index: 10; height: 700px; overflow-y: scroll;">


                        <h5 class="my-3 text-ucsp">
                            <i class="fa-solid fa-plus-circle me-3"></i> Announce Grade
                        </h5>

                        <form action="{{route('admin@announceGrade')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                              <label class="form-label" for="choices-multiple-remove-button"><span class="text-danger fw-bold">*</span> Search & select a student</label>
                              <select name="member[]" id="choices-multiple-remove-button" required="" multiple>
                                @foreach ($student as $stu)
                                    <option value="{{ $stu['user_id'] }}">{{ $stu['user_name']." · ".$stu['user_email'] }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="message"><span class="text-danger fw-bold">*</span> Message</label>
                                <input type="text" name="message" class="form-control" placeholder="5CS-13@1sem2024" required="">
                            </div>
                            <div class="form-group mb-3">
                              <label class="form-label" for="gradeFile"><span class="text-danger fw-bold">*</span> Select grade attachment file</label>
                              <input type="file" name="gradeFile" class="form-control" required="">
                          </div>
                            <div class="form-group mb-3 text-end">
                              <input type="submit" value="Send" name="announceGrade" class="btn btn-ucsp">
                            </div>
                        </form>

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp my-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger my-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push("script")

// for multiple select
$(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
   removeItemButton: true,
   maxItemCount:1,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

});
@endpush
