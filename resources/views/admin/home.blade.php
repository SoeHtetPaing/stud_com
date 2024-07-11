@extends('layouts.main')

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
                            <h6 class="text-ucsp p-1" style="font-size: 14px;">General</h6>
                            <li class="nav-item">
                                <a href="#" class="nav-link active-vertical-menu" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="bi-megaphone"></i>
                                    <span class="d-none d-lg-inline ms-3">Announcement</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-3">Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('student@setting')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <span class="d-none d-lg-inline ms-3">Lecturer</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('student@setting')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span class="d-none d-lg-inline ms-3">Student</span>
                                </a>
                            </li>
                            <hr>
                            <h6 class="text-ucsp p-1" style="font-size: 14px;">Managemant</h6>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="d-none d-lg-inline ms-3">Group</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            <hr>
                            <h6 class="text-ucsp p-1" style="font-size: 14px;">Personal</h6>
                            <li>
                                <a href="{{route('student@setting')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-gear-wide"></i>
                                    <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                </a>
                            </li>
                            <li class="d-none d-lg-inline">
                                <form action="{{route("logout")}}" method="post">
                                    @csrf
                                    <button type="submit" class="nav-link link-body-emphasis">
                                        <i class="bi bi-box-arrow-left"></i>
                                        <span class="d-none d-lg-inline ms-3">Sign out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>

                        <div class="d-lg-none">
                            <div class="dropdown">
                                <a href="#"
                                    class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('upload/pp.jpeg')}}" alt="" width="32" height="32"
                                        class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu text-small shadow">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left me-3"></i>Sign out</a></li>
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
                                <a href="{{route('user@chat')}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message"></span>
                                </a>
                            </div>
                        </div>
                        <div class="d-none d-lg-inline">
                            <div class="d-flex justify-content-center mt-1 ms-5">
                                <div class="position-relative">
                                    <h5 class="profile-title">{{$user->name}}</h5>
                                    <p class="profile-role">{{Str::words(Str::after($dept->name, 'Department of'), 2, '...')}}</p>
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
                    <div class="col-sm col-lg-9">
                        <div class=mb-3">

                            <!-- admin dashboard -->
                            <div class="d-flex" style="gap: 10px">
                                <div class="card-body bg-admin border rounded">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-user-tie fa-xl"></i></p>
                                    <p class="text-end">{{$adminNo}} <br>Admins</p>
                                </div>
                                <div class="card-body bg-teacher border rounded">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-chalkboard-user fa-xl"></i></p>
                                    <p class="text-end">{{$lecturerNo}} <br>Lecturers</p>
                                </div>
                                <div class="card-body bg-student border rounded">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-graduation-cap fa-xl"></i></p>
                                    <p class="text-end">{{$studentNo}} <br>Students</p>
                                </div>
                                <div class="card-body bg-white border rounded">
                                    <p class="position-absolute py-2"><i class="fa-solid fa-user-group fa-xl"></i></p>
                                    <p class="text-end">{{$adminNo + $lecturerNo + $studentNo}} <br>Totals</p>

                                </div>
                            </div>

                            {{-- add section nav --}}
                            <div class="mt-5">

                                <h5 class="ms-3 mb-2 text-ucsp">General</h5>

                                <div class="accordion" id="creationAccordion">

                                    {{-- add announcement --}}
                                    <div class="accordion-item rounded mb-3">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#creationOne" aria-expanded="true" aria-controls="creationOne">
                                            <i class="fa-solid fa-plus-circle me-3"></i> Create Announcement
                                        </button>
                                      </h2>
                                      <div id="creationOne" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                        <div class="accordion-body">
                                            <form action="{{route('admin@addAnnouncement')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group mb-3">
                                                  <label for="annoTitle"><span class="text-danger fw-bold">*</span> Enter announcement title</label>
                                                  <input type="text" name="annoTitle" class="form-control" required="" placeholder="Exam timetable များထုတ်ပြန်ကြေငြာခြင်း">
                                                </div>
                                                <div class="form-group mb-3">
                                                  <label for="annoContent"><span class="text-danger fw-bold">*</span> Enter announcement content</label>
                                                  <textarea name="annoContent" id="" cols="30" rows="8" class="form-control" placeholder="13.3.2024 ရက်မှ 24.3.2024 အထိ ကျင်းပပြုလုပ်မည့် exam timetable များမှာ..."></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                  <label for="annoImage"><span class="text-success fw-bold">*</span> Announcement photo is optional</label>
                                                  <input type="file" name="annoImage" class="form-control">
                                                </div>
                                                <div class="form-group mb-3 text-end">
                                                  <input type="submit" value="Post" name="addAnnouncement" class="btn btn-ucsp">
                                                </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>

                                    {{-- add admin --}}
                                    <div class="accordion-item rounded mb-3">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#creationTwo" aria-expanded="false" aria-controls="creationTwo">
                                            <i class="fa-solid fa-plus-circle me-3"></i> Add Admin
                                        </button>
                                      </h2>
                                      <div id="creationTwo" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                        <div class="accordion-body">
                                            <form action="{{route('admin@addAdmin')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-groub mb-3">
                                                  <label for="email"><span class="text-danger fw-bold">*</span> Enter email approve as admin</label>
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
                                          <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#craetionThree" aria-expanded="false" aria-controls="craetionThree">
                                              <i class="fa-solid fa-plus-circle me-3"></i> Add Lecturer
                                          </button>
                                        </h2>
                                        <div id="craetionThree" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                          <div class="accordion-body">
                                            <form action="{{route('admin@addLecturer')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-groub mb-3">
                                                  <label for="lectName"><span class="text-danger fw-bold">*</span> Enter lecturer name</label>
                                                  <input type="text" name="lectName" class="form-control" required="" placeholder="Daw Ni Ni Win">
                                                </div>
                                                <div class="form-groub mb-3">
                                                    <label for="lectEmail"><span class="text-danger fw-bold">*</span> Enter lecturer email</label>
                                                    <input type="email" name="lectEmail" class="form-control" required="" placeholder="niniwin@ucspyay.edu.mm">
                                                </div>
                                                <div class="form-groub mb-3">
                                                    <label for="dept"><span class="text-danger fw-bold">*</span> Select department name</label>
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
                                                <div class="form-groub mb-3">
                                                    <label for="lectPassword"><span class="text-success fw-bold">*</span> Default password for lecturer is <span class="text-ucsp">lecturer@ucsp</span></label>
                                                    <input type="password" name="lectPassword" class="form-control" required="" value="lecturer@ucsp">
                                                  </div>
                                                <div class="form-group mb-3">
                                                  <label for="lectImage"><span class="text-success fw-bold">*</span> Profile photo is optional</label>
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
                                          <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#creationFour" aria-expanded="false" aria-controls="creationFour">
                                              <i class="fa-solid fa-plus-circle me-3"></i> Add Student
                                          </button>
                                        </h2>
                                        <div id="creationFour" class="accordion-collapse collapse" data-bs-parent="#creationAccordion">
                                          <div class="accordion-body">
                                            <form action="{{route('admin@addStudent')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-groub mb-3">
                                                  <label for="stuName"><span class="text-danger fw-bold">*</span> Enter student name</label>
                                                  <input type="text" name="stuName" class="form-control" required="" placeholder="Soe Htet Paing">
                                                </div>
                                                <div class="form-groub mb-3">
                                                    <label for="stuEmail"><span class="text-danger fw-bold">*</span> Enter student email</label>
                                                    <input type="email" name="stuEmail" class="form-control" required="" placeholder="soehtetpaing@ucspyay.edu.mm">
                                                </div>
                                                <div class="form-groub mb-3">
                                                    <label for="dept"><span class="text-danger fw-bold">*</span> Select academic year</label>
                                                    <select name="dept" id="dept" class="form-select">
                                                        @foreach($stuDept as $item)
                                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-groub mb-3">
                                                    <label for="section"><span class="text-danger fw-bold">*</span> Select section</label>
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
                                                <div class="form-groub mb-3">
                                                    <label for="stuPassword"><span class="text-success fw-bold">*</span> Default password for student is <span class="text-ucsp">student@ucsp</span></label>
                                                    <input type="password" name="stuPassword" class="form-control" required="" value="student@ucsp">
                                                  </div>
                                                <div class="form-group mb-3">
                                                  <label for="stuImage"><span class="text-success fw-bold">*</span> Profile photo is optional</label>
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

                            {{-- add section for management, lecturer and student --}}
                            <div class="row mt-4">
                                {{-- for management --}}
                                <div class="col">
                                    <h5 class="ms-3 mb-2 text-ucsp">Management</h5>

                                    <div class="accordion" id="manageAccordion">

                                        {{-- add timetable --}}
                                        <div class="accordion-item mb-3">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#manageOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa-solid fa-plus-circle me-3"></i> Timetable add
                                            </button>
                                          </h2>
                                          <div id="manageOne" class="accordion-collapse collapse show rounded" data-bs-parent="#manageAccordion">
                                            <div class="accordion-body">
                                                <form action="{{route('admin@addTimetable')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-groub mb-3">
                                                        <label for="year"><span class="text-danger fw-bold">*</span> Select academic year</label>
                                                        <select name="year" id="year" class="form-select">
                                                            @foreach($stuDept as $item)
                                                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-groub mb-3">
                                                        <label for="section"><span class="text-danger fw-bold">*</span> Select section</label>
                                                        <select name="section" id="section" class="form-select">
                                                            <option value="Section A">Section A</option>
                                                            <option value="Section B">Section B</option>
                                                            <option value="Section C">Section C</option>
                                                            <option value="Section CT">Section CT</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-groub mb-3">
                                                        <label for="day"><span class="text-danger fw-bold">*</span> Select day</label>
                                                        <select name="day" id="day" class="form-select">
                                                            <option value="Monday">Monday</option>
                                                            <option value="Tueday">Tueday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Thurday">Thurday</option>
                                                            <option value="Friday">Friday</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-groub mb-3">
                                                        <label for="startHour"><span class="text-danger fw-bold">*</span> Select time interval</label>
                                                        <div class="row">
                                                            <div class="col">
                                                                <select name="startHour" id="startHour" class="form-select">
                                                                    <option value="9:00 AM">9:00 AM</option>
                                                                    <option value="10:00 AM">10:00 AM</option>
                                                                    <option value="11:00 AM">11:00 AM</option>
                                                                    <option value="12:00 PM">12:00 PM</option>
                                                                    <option value="1:00 PM">1:00 PM</option>
                                                                    <option value="2:00 PM">2:00 PM</option>
                                                                    <option value="3:00 PM">3:00 PM</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <select name="endHour" id="endHour" class="form-select">
                                                                    <option value="10:00 AM">10:00 AM</option>
                                                                    <option value="11:00 AM">11:00 AM</option>
                                                                    <option value="12:00 PM">12:00 PM</option>
                                                                    <option value="1:00 PM">1:00 PM</option>
                                                                    <option value="2:00 PM">2:00 PM</option>
                                                                    <option value="3:00 PM">3:00 PM</option>
                                                                    <option value="4:00 AM">4:00 PM</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-groub mb-3">
                                                      <label for="subjectCode"><span class="text-danger fw-bold">*</span> Enter subject code & name</label>
                                                      <div class="row">
                                                        <div class="col">
                                                            <input type="text" name="subjectCode" class="form-control" required="" placeholder="CST-1101">
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" name="subjectName" class="form-control" required="" placeholder="English">
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                      <label for="annoContent"><span class="text-danger fw-bold">*</span> Enter lecturer email</label>
                                                      <input type="text" name="lectEmail" class="form-control" required="" placeholder="lecturername@ucspyay.edu.mm">
                                                    </div>
                                                    <div class="form-group mb-3 text-end">
                                                      <input type="submit" value="Schedule a session" name="addTimetable" class="btn btn-ucsp">
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>

                                        {{-- add department --}}
                                        <div class="accordion-item rounded mb-3">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#manageTwo" aria-expanded="false" aria-controls="manageTwo">
                                                  <i class="fa-solid fa-plus-circle me-3"></i> Add Department
                                              </button>
                                            </h2>
                                            <div id="manageTwo" class="accordion-collapse collapse" data-bs-parent="#manageAccordion">
                                              <div class="accordion-body">
                                                  <form action="{{route('admin@addDepartment')}}" method="POST" enctype="multipart/form-data">
                                                      @csrf
                                                      <div class="form-groub mb-3">
                                                        <label for="deptName"><span class="text-danger fw-bold">*</span> Enter department name</label>
                                                        <input type="text" name="deptName" class="form-control" required="" placeholder="Department of Computer Science">
                                                      </div>
                                                      <div class="form-group mb-3 text-end">
                                                        <input type="submit" value="Add Department" name="addDepartment" class="btn btn-ucsp">
                                                      </div>
                                                  </form>
                                              </div>
                                            </div>
                                          </div>
                                    </div>

                                </div>
                                <div class="col">
                                    {{-- for lecturer --}}
                                    <h5 class="ms-3 mb-2 text-ucsp">Lecturer Related</h5>

                                    <div class="accordion mb-5" id="lecturerAccordion">

                                        <div class="accordion-item rounded mb-3">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lecturerOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa-solid fa-plus-circle me-3"></i> Add Lecturer Group
                                            </button>
                                          </h2>
                                          <div id="lecturerOne" class="accordion-collapse collapse" data-bs-parent="#lecturerAccordion">
                                            <div class="accordion-body">
                                              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                            </div>
                                          </div>
                                        </div>

                                    </div>

                                    {{-- for student --}}
                                    <h5 class="ms-3 mb-2 text-ucsp">Student Related</h5>

                                    <div class="accordion" id="studentAccordion">

                                        <div class="accordion-item rounded mb-3">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#studentOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa-solid fa-plus-circle me-3"></i> Add Student Group
                                            </button>
                                          </h2>
                                          <div id="studentOne" class="accordion-collapse collapse" data-bs-parent="#studentAccordion">
                                            <div class="accordion-body">
                                              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                            </div>
                                          </div>
                                        </div>

                                        <div class="accordion-item rounded mb-3">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#studentTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fa-solid fa-plus-circle me-3"></i> Grade announce
                                            </button>
                                          </h2>
                                          <div id="studentTwo" class="accordion-collapse collapse show" data-bs-parent="#studentAccordion">
                                            <div class="accordion-body">
                                              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                            </div>
                                          </div>
                                        </div>

                                    </div>

                                </div>
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

                        <div class="time-table mt-3 mb-3 rounded" style="position: sticky; top: 100px; z-index: 10;">
                            <div class="card">
                                <div class="card-body py-2">
                                    <h4 class="logo-title text-ucsp">Timetable today:</h4>
                                    <div style="line-height: 10px;">
                                        <p class="time-table-interval">9:00AM-10:00AM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>English</span></p>
                                        <p class="time-table-interval">10:00AM-11:00AM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>CST-502</span></p>
                                        <p class="time-table-interval">11:00AM-12:00PM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>CST-503</span></p>
                                        <p class="time-table-interval">1:00AM-2:00AM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>CST-501</span></p>
                                        <p class="time-table-interval">2:00AM-3:00AM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>CST-506</span></p>
                                        <p class="time-table-interval">3:00AM-4:00AM <span class="text-ucsp d-block mt-1"><i class="fa-solid fa-book me-3"></i>CST-505</span></p>
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
