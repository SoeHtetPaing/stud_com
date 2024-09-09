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
                                <a href="{{route('student@timetable')}}" class="nav-link active-vertical-menu">
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
                                <a href="{{route('student@grade')}}" class="nav-link link-body-emphasis">
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
                                <a href="{{route('user@chat', ['back' => 'student@timetable'])}}">
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

                    @if (count($tt) == 0)
                        <div class="my-5 text-center">
                            <div class="py-5 text-muted fs-5">
                                Oop! No data found<br>
                                <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                            </div>
                        </div>
                     @else

                     <div class="table-responsive mt-5">
                        <h5 class="ms-lg-4">{{$dept->name}} » {{$user->section}} » Timetable</h5>
                        <table class="table table-bordered text-center mx-auto" style="width: 1200px;">
                            <tr>
                                <th style="padding: 15px;"><i class="bi bi-calendar-day text-muted"></i></th>
                                <th style="padding: 15px;"><span class="text-ucsp fw-0">AM. </span> 9:00 - 10:00</th>
                                <th style="padding: 15px;">10:00 - 11:00</th>
                                <th style="padding: 15px;">11:00 - 12:00</th>
                                <th rowspan="6" style="vertical-align: middle;" class="text-muted"><i class="fa-solid fa-utensils"></i></th>
                                <th style="padding: 15px;"><span class="text-ucsp fw-0">PM. </span>1:00 - 2:00</th>
                                <th style="padding: 15px;">2:00 - 3:00</th>
                                <th style="padding: 15px;">3:00 - 4:00</th>
                            </tr>
                            @php
                                $d = ["Mon", "Tue", "Wed", "Thu", "Fri"];
                                $index = 0;

                                foreach ($tt as $day) {
                                echo "<tr>";

                                    echo "<td>".$d[$index]."</td>";

                                    foreach ($day as $t) {
                                        $start = substr($t["start_hour"], 0, strpos($t["start_hour"], ':'));
                                        $end = substr($t["end_hour"], 0, strpos($t["end_hour"], ':'));

                                        $interval = $end - $start;

                                        if ($interval == 2) {
                                          echo "<td colspan='2'>".$t["subject_code"]."</td>";
                                        } else {
                                          echo "<td>".$t["subject_code"]."</td>";

                                        }

                                    }

                                    $index++;
                                echo "</tr>";

                                }
                            @endphp
                        </table>
                     </div>

                    @endif


                    </div>

                    <div class="ms-lg-4 mb-3">

                        @if (count($tte) != 0)
                            <table>
                                @foreach ($tte as $e)
                                <tr>
                                    <td class="px-3 py-1">{{$e->subject_code}}</td>
                                    <td class="px-3 py-1">{{$e->subject_name}}</td>
                                    <td class="px-3 py-1">{{$e->lecturer_name}}</td>
                                </tr>

                                @endforeach
                            </table>

                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
