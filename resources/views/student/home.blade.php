@extends('layouts.main')

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
                            <li class="nav-item">
                                <a href="{{route('user@home')}}" class="nav-link active-vertical-menu" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('student@timetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('student@department')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('student@grade')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            @if ($user->role == "EC Student")
                                <li class="nav-item">
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
                                <a href="{{route('user@chat', ['back' => 'user@home'])}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message"></span>
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
                <div class="divider bg-muted m-0 p-0 mb-3" style="height: 1px;"></div>

                <div class="row text-dark">
                    <div class="col-sm col-lg-9">
                        <div class=mb-3">

                            <!-- admin dashboard -->
                            <div class="d-flex flex-column flex-md-row flex-lg-row flex-xl-row" style="gap: 10px">
                                <div class="w-25"></div>
                                <div class="w-25"></div>
                                <div class="card-body bg-student border rounded py-1 py-md-3 py-lg-3 py-xl-3">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-chalkboard-user fa-xl"></i></p>
                                    <p class="text-end">{{$deptLecturer}} <br>Class Mates</p>
                                </div>
                                <div class="card-body bg-white border rounded py-1 py-md-3 py-lg-3 py-xl-3">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-graduation-cap fa-xl"></i></p>
                                    <p class="text-end">{{$totStudent}} <br>Total Students</p>
                                </div>
                            </div>

                            <div class="my-3">
                                @if (count($data) == 0)
                                <div class="my-5 text-center">
                                    <div class="text-muted fs-5">
                                        Oop! No data found<br>
                                        <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                                    </div>
                                </div>
                             @else

                                @foreach ($data as $r)
                                    <div class="card mb-3">
                                        <div class="card-header my-card-header d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div class="me-2">
                                                    @if ($r["profile_photo_path"] == null)
                                                        <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                                    @else
                                                        <img src="{{ url('storage/'.$r->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                                                    @endif
                                                </div>
                                                <div class="d-flex align-item-center">
                                                    <div class="position-relative">
                                                        <h6 class="profile-title" style="width: 180px;">{{Str::words(Str::after($r->name, 'Daw'), 5, '...')}} ({{$r["role"]}})</h6>
                                                        <p class="profile-date">{{$r->created_at->format('D d F Y')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                @if ($r->is_seen == 0)
                                                <span class="btn btn-delete btn-danger p-1 m-1 px-lg-2 rounded-pill"><span class="d-none d-lg-inline">New</span></span>
                                                @else
                                                <span class="btn btn-delete btn-light p-1 m-1 px-lg-2 rounded-pill disabled"><span class="d-none d-lg-inline">Read</span></span>
                                                @endif
                                                <a href="{{route('user@viewAnnounce', $r['id'])}}" class="text-decoration-none">
                                                    <button class="btn btn-outline-ucsp"><i class="fa fa-info-circle me-lg-2"></i> <span class="d-none d-lg-inline">See more...</span></button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="text-ucsp">{{$r['title']}}</h6>
                                            <p class=" text-justify">{{Str::words($r['content'], 20, '...')}}</p>
                                            <small><a class="text-decoration-none" href="mailto:{{$r['email']}}">
                                                {{$r['email']}}
                                            </a></small>
                                        </div>
                                    </div>

                                @endforeach
                                {{$data->appends(request()->query())->links()}}
                            @endif
                            </div>


                        </div>
                    </div>


                    {{-- right side nav --}}
                    <div class="col-sm col-lg-3">
                        <section class="ftco-section" style="margin: 0; padding: 0;">
                            <div class="row">
                                <div class="col">
                                    <div class="elegant-calencar">
                                        <div class="bg-ucsp d-flex align-items-center">
                                            <div id="header" class="p-0">
                                                <div class="pre-button d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <div class="head-info">
                                                    <div class="head-day" style="font-size: 2.5rem; padding-top: 10px">17
                                                    </div>
                                                    <div class="head-month" style="font-size: 14px; padding-bottom: 10px;">
                                                        June - 2024</div>
                                                </div>
                                                <div class="next-button d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="calendar-wrap" style="padding: 5px 0;">
                                            <table id="calendar">
                                                <thead>
                                                    <tr>
                                                        <th>Sun</th>
                                                        <th>Mon</th>
                                                        <th>Tue</th>
                                                        <th>Wed</th>
                                                        <th>Thu</th>
                                                        <th>Fri</th>
                                                        <th>Sat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="" class="">1</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="" class="">2</td>
                                                        <td id="" class="">3</td>
                                                        <td id="" class="">4</td>
                                                        <td id="" class="">5</td>
                                                        <td id="" class="">6</td>
                                                        <td id="" class="">7</td>
                                                        <td id="" class="">8</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="" class="">9</td>
                                                        <td id="" class="">10</td>
                                                        <td id="" class="">11</td>
                                                        <td id="" class="">12</td>
                                                        <td id="" class="">13</td>
                                                        <td id="" class="">14</td>
                                                        <td id="" class="">15</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="" class="">16</td>
                                                        <td id="today" class="">17</td>
                                                        <td id="" class="">18</td>
                                                        <td id="" class="">19</td>
                                                        <td id="" class="">20</td>
                                                        <td id="" class="">21</td>
                                                        <td id="" class="">22</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="" class="">23</td>
                                                        <td id="" class="">24</td>
                                                        <td id="" class="">25</td>
                                                        <td id="" class="">26</td>
                                                        <td id="" class="">27</td>
                                                        <td id="" class="">28</td>
                                                        <td id="" class="">29</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="" class="">30</td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                        <td id="disabled" class=""></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <div class="time-table mt-3 mb-3">
                            <div class="card">
                                <div class="card-body py-2">
                                    <h4 class="logo-title text-ucsp">Timetable today:</h4>
                                    <div style="line-height: 18px;">
                                        @if (count($sttt) == 0)
                                            <div class="my-5 text-center">
                                                <div class="text-muted fs-5">
                                                    Oop! No data found<br>
                                                    <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                                                </div>
                                            </div>
                                        @else
                                            @foreach ($sttt as $r)
                                                <p class="timetable-interval">
                                                    {{$r->start_hour." - ".$r->end_hour}}
                                                    <span class="text-ucsp d-block mt-1" style="font-size: 15px;">
                                                        <i class="fa-solid fa-book me-3"></i>
                                                        {{$r->subject_code." ".$r->subject_name}}:
                                                        <span class="text-dark ms-1">{{$r->lecturer_name}}</span>
                                                    </span>
                                                </p>

                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
