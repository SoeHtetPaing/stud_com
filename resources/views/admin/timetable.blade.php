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
                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">General</h6>
                            <li class="nav-item">
                                <a href="{{route('user@home')}}" class="nav-link link-body-emphasis" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageAnnounce')}}" class="nav-link link-body-emphasis">
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
                            <hr>
                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">Managemant</h6>
                            <li>
                                <a href="{{route('admin@manageTimetable')}}" class="nav-link active-vertical-menu">
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
                            <hr>
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
                                                <span class="d-none d-lg-inline ms-3">Sign out</span>
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
                                <a href="{{route('user@chat', ['back' => 'admin@manageTimetable'])}}">
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

                    {{-- user content --}}
                    <div class="col-sm col-lg-8">

                        <div class="mb-3">
                            <div class="bg-white border rounded-pill">
                                <form action="{{route('admin@manageTimetable')}}" method="get">
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
                                                    @if ($r["profile_photo"] == null)
                                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                                    @else
                                                    <img src="{{ asset('storage/upload/'.$r->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                                                    @endif
                                                </div>
                                                <div class="d-flex align-item-center">
                                                    <div class="position-relative">
                                                        <h6 class="profile-title">{{Str::words(Str::after($r->name, 'Daw'), 5, '...')}}</h6>
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
                                                <small><a href="mailto:{{$r['email']}}">
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
                                                @if ($r['section'] != "")
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
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp mb-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger mb-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                        <div class="accordion mt-3" id="manageAccordion">

                            {{-- add timetable --}}
                            <div class="accordion-item mb-3">
                              <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#manageOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-plus-circle me-3"></i> Schedule a timetable
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
                                            <label for="choices-multiple-remove-button"><span class="text-danger fw-bold">*</span> Search & select a subject</label>
                                            <select name="subject[]" id="choices-multiple-remove-button" required="" multiple>
                                              @foreach ($subject as $sub)
                                                  <option value="{{ $sub['id'] }}">{{ $sub['subject_code']." · ".$sub['subject_name'] }}</option>
                                              @endforeach
                                          </select>
                                          </div>
                                          <div class="form-groub mb-3">
                                            <label for="choices-multiple-remove-button-1"><span class="text-danger fw-bold">*</span> Search & select lecturer</label>
                                            <select name="lecturer[]" id="choices-multiple-remove-button-1" required="" multiple>
                                                @foreach ($lecturer as $lect)
                                                <option value="{{ $lect['user_name'] }}">{{ $lect['user_name']." · ".$lect['dept_name'] }}</option>
                                                @endforeach
                                          </select>
                                          </div>
                                        <div class="form-group mb-3 text-end">
                                          <input type="submit" value="Schedule a session" name="addTimetable" class="btn btn-ucsp">
                                        </div>
                                    </form>
                                </div>
                              </div>
                        </div>

                            {{-- add subject --}}
                            <div class="accordion-item rounded mb-3">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed border-top rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#manageTwo" aria-expanded="false" aria-controls="manageTwo">
                                      <i class="fa-solid fa-plus-circle me-3"></i> Add Subject
                                  </button>
                                </h2>
                                <div id="manageTwo" class="accordion-collapse collapse" data-bs-parent="#manageAccordion">
                                  <div class="accordion-body">
                                    <form action="{{route('admin@addSubjectInTimetable')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="term"><span class="text-danger fw-bold">*</span> Select semester term</label>
                                            <select name="term" id="section" class="form-select">
                                                <option value="First Term CS">First Term CS</option>
                                                <option value="First Term CT">First Term CT</option>
                                                <option value="Second Term CS">Second Term CS</option>
                                                <option value="Second Term CT">Second Term CT</option>
                                            </select>
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
                                        <div class="form-group mb-3 text-end">
                                          <input type="submit" value="Add Subject" name="addSubject" class="btn btn-ucsp">
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

@push("script")

// for multiple select
$(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
   removeItemButton: true,
   maxItemCount:1,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

 var multipleCancelButton1 = new Choices('#choices-multiple-remove-button-1', {
   removeItemButton: true,
   maxItemCount:1,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

});
@endpush
