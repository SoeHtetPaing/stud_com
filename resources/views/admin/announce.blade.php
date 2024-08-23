@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-admin" style="position: sticky; top: 0;">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image" style="margin-top: 6.8px;">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">(admin)</span></h>
                    </div>
                    <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 1px;"></div>

                    <div class="d-flex flex-column flex-shrink-0">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <h6 class="text-ucsp ps-1 d-none d-lg-inline" style="font-size: 14px;">General</h6>
                            <li class="nav-item">
                                <a href="{{route('user@home')}}" class="nav-link link-body-emphasis" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageAnnounce')}}" class="nav-link active-vertical-menu">
                                    <i class="bi-megaphone"></i>
                                    <span class="d-none d-lg-inline ms-3">Announcement</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageUser')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-3">User</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 0.7px;"></div>

                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Managemant</h6>
                            <li>
                                <a href="{{route('admin@manageTimetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageDepartment')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageGroup')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="d-none d-lg-inline ms-3">Group</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageGrade')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 1px;"></div>

                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Personal</h6>
                            <li class="d-none d-lg-inline">
                                <a href="{{route('admin@manageProfile')}}" class="nav-link link-body-emphasis">
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
                                    @if ($user->profile_photo == null)
                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                    @else
                                    <img src="{{ asset('storage/upload/'.$user->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                                    @endif
                                </a>
                                <ul class="dropdown-menu text-small shadow">
                                    <li>
                                        <a href="{{route('admin@manageProfile')}}" class="nav-link link-body-emphasis">
                                            <i class="bi bi-gear-wide"></i>
                                            <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                        </a>
                                    </li>
                                    <li>
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
                                <a href="{{route('user@chat', ['back' => 'admin@manageAnnounce'])}}">
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
                                    @if ($user->profile_photo == null)
                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                    @else
                                    <img src="{{ asset('storage/upload/'.$user->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-dark">

                    {{-- announcement content --}}
                    <div class="col-sm col-lg-8">

                        <div class="mb-3">
                            <div class="bg-white border rounded-pill">
                                <form action="{{route('admin@manageAnnounce')}}" method="get">
                                    <div class="input-group px-3 py-2">
                                        <input type="text" value="{{request('key')}}" name="key" class="search-input" placeholder="Search">
                                        <button class="search-btn" type="submit"><i class="fa fa-search text-ucsp"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>


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
                                                @if ($r["profile_photo"] == null)
                                                <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                                @else
                                                <img src="{{ asset('storage/upload/'.$r->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                                                @endif
                                            </div>
                                            <div class="d-flex align-item-center">
                                                <div class="position-relative">
                                                    <h6 class="profile-title">{{Str::words(Str::after($r->name, 'Daw'), 5, '...')}} ({{$r["role"]}})</h6>
                                                    <p class="profile-date">{{$r->created_at->format('D d F Y')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <a href="{{route('admin@deleteAnnounce', $r['id'])}}" class="text-decoration-none">
                                                <button class="btn btn-delete btn-danger"><i class="fa fa-trash me-lg-2"></i> <span class="d-none d-lg-inline">Delete</span></button>
                                            </a>
                                            <a href="{{route('admin@showAnnounce', $r['id'])}}" class="text-decoration-none">
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

                    <div class="col-sm col-lg-4 bg-white">

                        <h5 class="my-3 text-ucsp">
                            <i class="fa-solid fa-plus-circle me-3"></i> Create Announcement
                        </h5>

                        <form action="{{route('admin@addAnnouncement')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                              <label class="form-label" for="annoTitle"><span class="text-danger fw-bold">*</span> Enter announcement title</label>
                              <input type="text" name="annoTitle" class="form-control" required="" placeholder="Exam timetable များထုတ်ပြန်ကြေငြာခြင်း">
                            </div>
                            <div class="form-group mb-3">
                              <label class="form-label" for="annoContent"><span class="text-danger fw-bold">*</span> Enter announcement content</label>
                              <textarea name="annoContent" id="" cols="30" rows="8" class="form-control" required="" placeholder="13.3.2024 ရက်မှ 24.3.2024 အထိ ကျင်းပပြုလုပ်မည့် exam timetable များမှာ..."></textarea>
                            </div>
                            <div class="form-group mb-3">
                              <label class="form-label" for="annoImage"><span class="text-success fw-bold">*</span> Announcement photo is optional</label>
                              <input type="file" name="annoImage" class="form-control">
                            </div>
                            <div class="form-group mb-3 text-end">
                              <input type="submit" value="Post" name="addAnnouncement" class="btn btn-ucsp">
                            </div>
                        </form>

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp mb-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger mb-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
