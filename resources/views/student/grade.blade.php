@extends('layouts.main-clone')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-student" style="position: sticky; top: 0;">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image" style="margin-top: 6.8px;">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">(student)</span></h>
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
                                <a href="{{route('student@timetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('student@department')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('student@grade')}}" class="nav-link active-vertical-menu">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            @if ($user->role == "EC Student")
                                <li class="nav-item py-1">
                                    <a href="{{route('student@group')}}" class="nav-link link-body-emphasis">
                                        <i class="bi bi-people-fill"></i>
                                        <span class="d-none d-lg-inline ms-3">Group</span>
                                    </a>
                                </li>
                            @endif
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
                                <a href="{{route('user@chat', ['back' => 'student@grade'])}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                    @if ($chatNoti != 0)
                                        <span class="position-absolute translate-middle px-1 bg-danger border border-2 border-light rounded-pill absolute-message fw-bold">{{$chatNoti}}</span>
                                    @endif
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
                <div class="divider bg-muted m-0 p-0" style="height: 1px;"></div>


                <div class="row text-dark">


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
                                                    <div class="d-flex">
                                                        <div class="me-2">
                                                            @if ($r["uimage"] == null)
                                                                <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                                            @else
                                                                <img src="{{ url('storage/'.$r->uimage) }}" alt="profile" class="profile-icon rounded-circle">
                                                            @endif
                                                        </div>
                                                        <div class="d-flex align-item-center">
                                                            <div class="position-relative">
                                                                <h6 class="profile-title" style="width: 180px;">{{Str::words(Str::after($r->uname, 'Daw'), 5, '...')}}</h6>
                                                                <p class="profile-date">ANOID:GD2ANO#{{$r["cid"]."".$r["gid"]."".$r["mid"]}}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6 col-md-3">
                                                        <div class="position-relative bg-student border rounded" style="height: 150px;">
                                                            <div class="position-absolute" style="top: 20%; left: 25%" title="Click file to view result">
                                                                @php
                                                                    $type = Str::words(Str::after($r->cfile, '.'), 5);
                                                                @endphp
                                                                @if ($type == "pdf")
                                                                    <a href="{{asset('storage/upload/'.$r->cfile.'')}}" class="text-decoration-none attachment" style="font-size: 4rem;"><i class="fa-regular fa-file-pdf fa-lg me-1"></i></a>
                                                                @else
                                                                    <a href="{{asset('storage/upload/'.$r->cfile.'')}}" class="text-decoration-none attachment" style="font-size: 4rem;"><i class="fa-regular fa-file-image fa-lg me-2"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 col-md-9 mt-md-5">
                                                        <p class="m-0 w-100 text-end">
                                                            <i class="fa-solid fa-medal bg-ucsp p-2 rounded-circle text-white"></i>

                                                        </p>
                                                        <p class="m-0 w-100 text-end">
                                                            <span class="text-muted d-none d-md-inline" style="font-size: 13px;">Notice:&emsp;</span>
                                                            <span style="font-size: 15px;">
                                                                {{$r['cmessage']}}
                                                            </span>
                                                        </p>

                                                        <p class="m-0 w-100 text-end">
                                                            <span class="text-muted d-none d-md-inline" style="font-size: 13px;">Announce Date:&emsp;</span>
                                                            <span style="font-size: 15px;">
                                                                {{$r->created_at->format('D d/m/y')}}
                                                            </span>
                                                        </p>

                                                        <p class="m-0 text-end">
                                                            <span class="text-muted d-none d-md-inline" style="font-size: 13px;">Announcer Mail:&emsp;</span>
                                                            <small><a class="text-decoration-none" href="mailto:{{$r['uemail']}}">
                                                                {{$r['uemail']}}
                                                            </a></small>
                                                        </p>
                                                    </div>

                                                </div>



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
    </div>
@endsection
