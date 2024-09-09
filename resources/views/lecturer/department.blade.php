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
                                <a href="{{route('lecturer@department')}}" class="nav-link active-vertical-menu">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('lecturer@group')}}" class="nav-link link-body-emphasis">
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
                        <p class="text-ucsp">
                            @if (\Session::has('message'))
                                {{ \Session::get('message') }}
                            @endif
                        </p>
                        <p class="text-danger">
                            @if (\Session::has('error'))
                                {{ \Session::get('error') }}
                            @endif
                        </p>
                    </div>
                    <div class="lg-profile d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="position-relative p-2">
                                <a href="{{route('user@chat', ['back' => 'lecturer@department'])}}">
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

                    <div class=mb-3">

                        @if ($dept == null)
                        <div class="my-5 text-center">
                            <div class="py-5 text-muted fs-5">
                                Oop! No data found<br>
                                <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                            </div>
                        </div>
                     @else

                     <div class="container">

                        <div class="pt-3 px-md-5 mb-2 bg-light"  style="position: sticky; top: 58px; z-index: 4;">
                            <div class="d-flex align-items-center">
                                <div class="d-flex mt-1 mb-1">
                                    <div class="">
                                        <img src="{{asset('img/favicon/ucsp.jpg')}}" alt="profile" class="rounded-circle" style="width: 50px;">
                                    </div>
                                    <div class="d-flex align-item-center ms-3">
                                        <div class="">
                                            <h6 class="text-ucsp m-0 p-0 py-1" style="font-size: 12px;">
                                                {{$dept["name"]}}
                                            </h6>
                                            <h6 class="">UCSP@DEPT#{{$dept->id}}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row px-md-5">

                            @if (count($member) == 0)
                                   <div class="my-5 text-center">
                                       <div class="text-muted fs-5">
                                           Oop! No data found<br>
                                           <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                                       </div>
                                   </div>
                            @else

                                    <div class=" py-3 rounded bg-light" style="position: sticky; top: 132px; z-index: 3;">
                                        <div class="d-flex justify-content-between mx-2">
                                            <h6 class="text-ucsp">Member Lists</h6>
                                            <h6 class="position-relative">
                                                <span class="text-black-50">Totals: <span class="text-black fw-bold">{{count($member)}}</span></span>
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover" style="width: 1129px;">
                                            @foreach ($member as $r)
                                            <tr>
                                                <td>
                                                    @if ($r["profile_photo_path"] == null)
                                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                                    @else
                                                    <img src="{{ url('storage/'.$r->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$r->name}}
                                                    @if ($r['gendar'] == "Male")
                                                         <i class="fa-solid fa-mars text-warning ms-3"></i>
                                                     @else
                                                         <i class="fa-solid fa-venus ms-3" style="color: deeppink;"></i>
                                                     @endif
                                                </td>
                                                <td>
                                                    {{$r['email']}}
                                                </td>
                                                <td>
                                                    {{$r['role']}}
                                                </td>
                                                <td>
                                                    <a href="mailto:{{$r->email}}">
                                                        <button class="btn btn-sm btn-ucsp"><i class="bi bi-chat-fill"></i></button>

                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </table>

                                    </div>

                            @endif

                        </div>
                    </div>

                    @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
