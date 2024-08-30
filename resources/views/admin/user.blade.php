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
                            <li class="nav-item">
                                <a href="{{route('admin@manageAnnounce')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-megaphone"></i>
                                    <span class="d-none d-lg-inline ms-3">Announcement</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin@manageUser')}}" class="nav-link active-vertical-menu">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-3">User</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 mt-2 mb-3" style="height: 0.7px;"></div>

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
                                <a href="{{route('admin@manageGrade')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
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
                                <a href="{{route('user@chat', ['back' => 'admin@manageUser'])}}">
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

                <div class="row text-dark">

                    {{-- user content --}}
                    <div class="col-sm col-lg-8">

                        <div class="mb-3">
                            <div class="bg-white border rounded-pill">
                                <form action="{{route('admin@manageUser')}}" method="get">
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

                            <div class="row">
                            @foreach ($data as $r)

                                <div class="col-sm col-md-12 col-lg-6 col-xl-6 mb-3">
                                    <div class="card" style="height: 275px;">
                                        <div class="card-header my-card-header">
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
                                                        <h6 class="profile-title" style="width: 200px;">{{Str::words(Str::after($r->name, 'Daw'), 5, '...')}}</h6>
                                                        <p class="profile-date">
                                                            {{$r->role}}
                                                            @if ($r['gendar'] == "Male")
                                                                <i class="fa-solid fa-mars text-warning"></i>
                                                            @else
                                                                <i class="fa-solid fa-venus" style="color: deeppink;"></i>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="m-0 text-end">
                                                <span class="text-muted" style="font-size: 13px;">Name:&emsp;</span>
                                                <span style="font-size: 15px;">
                                                    {{$r['name']}}
                                                </span>
                                            </p>

                                            <p class="m-0 text-end">
                                                <span class="text-muted" style="font-size: 13px;">Email:&emsp;</span>
                                                <small><a class="text-decoration-none" href="mailto:{{$r['email']}}">
                                                    {{$r['email']}}
                                                </a></small>
                                            </p>
                                            <p class="m-0 text-end">
                                                <span class="text-muted" style="font-size: 13px;">Department:&emsp;</span>
                                                <span style="font-size: 15px;">
                                                    {{Str::words(Str::after($r->dept_name, 'Department of'), 4, '...')}}
                                                </span>
                                            </p>
                                            <p class="m-0 text-end">
                                                @if ($r['section'] != "NA")
                                                <span class="text-muted" style="font-size: 13px;">Section:&emsp;</span>
                                                <span style="font-size: 15px;">
                                                    {{$r['section']}}
                                                </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="card-footer text-end">
                                            <a href="{{route('admin@deleteUser', $r['id'])}}" class="text-decoration-none">
                                                <button class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>
                                            </a>
                                            <a href="{{route('admin@editUser', $r['id'])}}" class="text-decoration-none">
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

                    <div class="col-sm col-lg-4 bg-white"  style="position: sticky; top: 65px; z-index: 10; height: 700px; overflow-y: scroll;">

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp my-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger my-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                        <div class="accordion mt-3" id="creationAccordion">
                            {{-- add admin --}}
                            <div class="accordion-item rounded mb-3">
                              <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#creationOne" aria-expanded="false" aria-controls="creationTwo">
                                    <i class="fa-solid fa-plus-circle me-3"></i> Approve Admin
                                </button>
                              </h2>
                              <div id="creationOne" class="accordion-collapse collapse show" data-bs-parent="#creationAccordion">
                                <div class="accordion-body">
                                    <form action="{{route('admin@addAdmin')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                          <label class="form-label" for="email"><span class="text-danger fw-bold">*</span> Enter email approve as admin</label>
                                          <input type="email" name="adminEmail" class="form-control" required="" placeholder="username@ucspyay.edu.mm">
                                        </div>
                                        <div class="form-group mb-3 text-end">
                                          <input type="submit" value="Approve as Admin" name="addAdmin" class="btn btn-ucsp">
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>

                            {{-- add lecturer --}}
                            <div class="accordion-item rounded mb-3">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#craetionTwo" aria-expanded="false" aria-controls="craetionThree">
                                      <i class="fa-solid fa-plus-circle me-3"></i> Add Lecturer
                                  </button>
                                </h2>
                                <div id="craetionTwo" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                  <div class="accordion-body">
                                    <form action="{{route('admin@addLecturer')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                          <label class="form-label" for="lectName"><span class="text-danger fw-bold">*</span> Enter lecturer name</label>
                                          <input type="text" name="lectName" class="form-control" required="" placeholder="Daw Ni Ni Win">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="lectEmail"><span class="text-danger fw-bold">*</span> Enter lecturer email</label>
                                            <input type="email" name="lectEmail" class="form-control" required="" placeholder="niniwin@ucspyay.edu.mm">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="phone"><span class="text-danger fw-bold">*</span> Enter lecturer phone</label>
                                            <input type="text" name="phone" class="form-control" required="" placeholder="09755089001">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="dept"><span class="text-danger fw-bold">*</span> Select department name</label>
                                            <select name="dept" id="dept" class="form-select">
                                                @foreach($lectDept as $item)
                                                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Male" checked>
                                                <label class="form-check-label" for="gendar">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Female">
                                                <label class="form-check-label" for="inlineRadio2">Female</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="address"><span class="text-danger fw-bold">*</span> Enter lecturer address</label>
                                            <input type="text" name="address" class="form-control" required="" placeholder="Magway">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="lectPassword"><span class="text-success fw-bold">*</span> Default password for lecturer is <span class="text-ucsp">lecturer@ucsp</span></label>
                                            <input type="password" name="lectPassword" class="form-control" required="" value="lecturer@ucsp">
                                          </div>
                                        <div class="form-group mb-3">
                                          <label class="form-label" for="lectImage"><span class="text-success fw-bold">*</span> Profile photo is optional</label>
                                          <input type="file" name="lectImage" class="form-control">
                                        </div>
                                        <div class="form-group mb-3 text-end">
                                          <input type="submit" value="Add Lecturer" name="addLecturer" class="btn btn-ucsp">
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>

                            {{-- add student --}}
                            <div class="accordion-item rounded mb-3">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#creationThree" aria-expanded="false" aria-controls="creationFour">
                                      <i class="fa-solid fa-plus-circle me-3"></i> Add Student
                                  </button>
                                </h2>
                                <div id="creationThree" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                  <div class="accordion-body">
                                    <form action="{{route('admin@addStudent')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                          <label class="form-label" for="stuName"><span class="text-danger fw-bold">*</span> Enter student name</label>
                                          <input type="text" name="stuName" class="form-control" required="" placeholder="Soe Htet Paing">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="stuEmail"><span class="text-danger fw-bold">*</span> Enter student email</label>
                                            <input type="email" name="stuEmail" class="form-control" required="" placeholder="soehtetpaing@ucspyay.edu.mm">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="phone"><span class="text-danger fw-bold">*</span> Enter student phone</label>
                                            <input type="text" name="phone" class="form-control" required="" placeholder="09784440048">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="dept"><span class="text-danger fw-bold">*</span> Select academic year</label>
                                            <select name="dept" id="dept" class="form-select">
                                                @foreach($stuDept as $item)
                                                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="section"><span class="text-danger fw-bold">*</span> Select section</label>
                                            <select name="section" id="section" class="form-select">
                                                <option value="Section A">Section A</option>
                                                <option value="Section B">Section B</option>
                                                <option value="Section C">Section C</option>
                                                <option value="Section CT">Section CT</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Male" checked>
                                                <label class="form-check-label" for="gendar">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Female">
                                                <label class="form-check-label" for="inlineRadio2">Female</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="address"><span class="text-danger fw-bold">*</span> Enter student address</label>
                                            <input type="text" name="address" class="form-control" required="" placeholder="Pyay">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="stuPassword"><span class="text-success fw-bold">*</span> Default password for student is <span class="text-ucsp">student@ucsp</span></label>
                                            <input type="password" name="stuPassword" class="form-control" required="" value="student@ucsp">
                                          </div>
                                        <div class="form-group mb-3">
                                          <label class="form-label" for="stuImage"><span class="text-success fw-bold">*</span> Profile photo is optional</label>
                                          <input type="file" name="stuImage" class="form-control">
                                        </div>
                                        <div class="form-group mb-3 text-end">
                                          <input type="submit" value="Add Student" name="addStudent" class="btn btn-ucsp">
                                        </div>
                                    </form>
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
