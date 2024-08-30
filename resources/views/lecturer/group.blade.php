@extends('layouts.main-clone')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-teacher" style="position: sticky; top: 0;">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image" style="margin-top: 6.8px;">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">(lecturer)</span></h>
                    </div>
                    <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 1px;"></div>

                    <div class="d-flex flex-column flex-shrink-0">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <h6 class="text-ucsp ps-1 d-none d-lg-inline" style="font-size: 14px;">General</h6>
                            <li class="nav-item py-1">
                                <a href="{{route('user@home')}}" class="nav-link link-body-emphasis" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('lecturer@timetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('lecturer@department')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('lecturer@group')}}" class="nav-link active-vertical-menu">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="d-none d-lg-inline ms-3">Group</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 1px;"></div>

                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Personal</h6>
                            <li class="d-none d-lg-inline">
                                <a href="{{route('user@manageProfile')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-gear-wide"></i>
                                    <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                </a>
                            </li>
                            <li class="d-none d-lg-inline">
                                <form action="{{route("user@logout")}}" method="post">
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
                                        <form action="{{route("user@logout")}}" method="post">
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
                                <a href="{{route('user@chat', ['back' => 'lecturer@group'])}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message" style="top: 0.9rem; right: 0.4rem;"></span>
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

                    <div class="col-sm col-lg-8">

                        <div class="mb-3">
                            <div class="bg-white border rounded-pill">
                                <form action="{{route('student@group')}}" method="get">
                                    <div class="input-group px-3 py-2">
                                        <input type="text" value="{{request('key')}}" name="key" class="search-input" placeholder="Search by group name">
                                        <button class="search-btn" type="submit"><i class="fa fa-search text-ucsp"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mx-2"  style="height: 630px; overflow-y: scroll;">


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
                                    @foreach ($data as $r)

                                        <div class="col-sm col-md-12 col-lg-6 col-xl-6 mb-3">
                                            <div class="card">
                                                <div class="card-header my-card-header">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-item-center">
                                                            <div class="position-relative">
                                                                <h6 class="profile-title fw-bold" style="width: 200px; font-family: 'Cutive Mono';">UCSP@GROUP#{{$r['id']}}</h6>
                                                                <p class="profile-date" style="bottom: -1.3rem; font-family: 'Source Serif 4';">
                                                                    <span class="text-muted">Creater:&nbsp;</span>

                                                                    @if ($r->profile_photo_path == null)
                                                                    <i class="fa-solid fa-user-circle mx-1" style="font-size: 12px; color: #0097b2"></i>
                                                                    @else
                                                                    <img src="{{ url('storage/'.$r->profile_photo_path) }}" alt="creater-photo" style="width: 12px; height: 12px;" class="rounded-circle mx-1">
                                                                    @endif

                                                                    {{Str::words(Str::after($r->user_name, 'Daw'), 3, '...')}}
                                                                    &nbsp;·&nbsp;
                                                                    @if ($r['gendar'] == "Male")
                                                                        <i class="fa-solid fa-mars text-warning"></i>
                                                                    @else
                                                                        <i class="fa-solid fa-venus" style="color: deeppink;"></i>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            @if ($r->image == null)
                                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="profile-icon rounded-circle">
                                                            @else
                                                            <img src="{{ asset('storage/upload/'.$r->image) }}" alt="profile" class="profile-icon rounded-circle">
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <p class="m-0 w-100 text-end">
                                                        <span class="text-muted" style="font-size: 13px;">Group Name:&emsp;</span>
                                                        <span style="font-size: 15px;">
                                                            {{$r['name']}}
                                                        </span>
                                                    </p>

                                                    <p class="m-0 w-100 text-end">
                                                        <span class="text-muted" style="font-size: 13px;">Created Date:&emsp;</span>
                                                        <span style="font-size: 15px;">
                                                            {{$r->created_at->format('D d F Y')}}
                                                        </span>
                                                    </p>

                                                    <p class="m-0 text-end">
                                                        <span class="text-muted" style="font-size: 13px;">Creater Mail:&emsp;</span>
                                                        <small><a class="text-decoration-none" href="mailto:{{$r['email']}}">
                                                            {{$r['email']}}
                                                        </a></small>
                                                    </p>

                                                </div>
                                                <div class="card-footer text-end">
                                                    <a href="{{route('admin@deleteGroup', $r['id'])}}" class="text-decoration-none">
                                                        <button class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>
                                                    </a>
                                                    <a href="{{route('lecturer@editGroup', $r['id'])}}" class="text-decoration-none">
                                                        <button class="btn btn-sm btn-outline-ucsp"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                            </div>
                            {{$data->appends(request()->query())->links()}}
                        @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-sm col-lg-4 bg-white pt-3"  style="position: sticky; top: 65px; z-index: 10; height: 700px; overflow-y: scroll;">

                        <h5 class="my-3 text-ucsp">
                            <i class="fa-solid fa-plus-circle me-3"></i> Create Group
                        </h5>

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp my-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger my-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                        <form action="{{route('admin@createCustomGroup')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label" for="groupName"><span class="text-danger fw-bold">*</span> Enter group name</label>
                                <input type="text" name="groupName" id="groupName" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                              <label class="form-label" for="choices-multiple-remove-button"><span class="text-danger fw-bold">*</span> Select group members</label>
                              <select name="member[]" id="choices-multiple-remove-button" multiple>
                                @foreach ($custom as $usr)
                                    <option value="{{ $usr['user_id'] }}">{{ $usr['user_name']." · ".$usr['dept_name'] }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group mb-3">
                              <label class="form-label" for="groupImage"><span class="text-success fw-bold">*</span> Group photo is optional</label>
                              <input type="file" name="groupImage" class="form-control">
                          </div>
                            <div class="form-group mb-3 text-end">
                              <input type="submit" value="Create Group" name="addCustomGroup" class="btn btn-ucsp">
                            </div>
                        </form>

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
   maxItemCount:50,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

});
@endpush
