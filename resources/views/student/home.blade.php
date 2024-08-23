@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-student">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image mt-1">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">(student)</span></h>
                    </div>
                    <hr>
                    <div class="d-flex flex-column flex-shrink-0">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link active-vertical-menu" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('student@setting')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-gear-wide"></i>
                                    <span class="d-none d-lg-inline ms-3">Settings</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <li class="d-none d-lg-inline">
                            <form action="{{route("logout")}}" method="post">
                                @csrf
                                <button type="submit" class="nav-link link-body-emphasis">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span class="d-none d-lg-inline ms-3">Log out</span>
                                </button>
                            </form>
                        </li>
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
                <div class="horizontal-menu py-2 mt-1 d-flex justify-content-between">
                    <label class="form-label" for="announce-alert" class="announce-alert bg-white rounded-pill border py-2 px-3 d-flex">
                        <i class="bi-megaphone-fill pe-2 text-ucsp"></i>
                        <marquee direction="rtl" class="text-ucsp">This is new announce.</marquee>
                    </label>
                    <div class="lg-profile d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="position-relative p-2">
                                <a href="">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message"></span>
                                </a>
                            </div>
                        </div>
                        <div class="d-none d-lg-inline">
                            <div class="d-flex justify-content-center mt-1 ms-5">
                                <div class="profile-group position-relative">
                                    <h5 class="profile-title">{{$user->name}}</h5>
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


                <div class="row">
                    <div class="col-sm col-lg-9">
                        <div class=mb-3">

                            <!-- announcement design -->
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                            @else
                                            <img src="{{ asset('upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="d-flex align-item-center">
                                            <div class="position-relative">
                                                <h6 class="profile-title">Administraction</h6>
                                                <p class="profile-date">5.6.2024</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-ucsp">See more...</button>
                                    </div>
                                </div>
                                <div class="card-body text-justify">
                                    6.6.2024 မှစ၍ ကွန်ပျူတာတက္ကသိုလ်ပြည် ပထမနှစ်မှ စတုတ္ထနှစ်အထိ သင်တန်းများ စတင်ဖွင့်လှစ်မည်ဖြစ်ကြောင်း ကြေငြာအပ်ပါသည်။ ကျောင်းအပ်ရာတွင်.....
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                            @else
                                            <img src="{{ asset('upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="d-flex align-item-center">
                                            <div class="position-relative">
                                                <h6 class="profile-title">Administraction</h6>
                                                <p class="profile-date">2024-5-19</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-ucsp">See more...</button>
                                    </div>
                                </div>
                                <div class="card-body text-justify">
                                    19.5.2024 ရက်မှစ၍ exam result များ အတန်းလိုက်ပေးပို့နေပါပြီ။ ကျောင်းသားများအားလုံး edu mail များမှတစ်ဆင့် မိမိတို့ grade များအား ၀င်ရောက် ကြည့်ရှုနိုင်ပြီဖြစ်ကြောင်း...
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                            @else
                                            <img src="{{ asset('upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="d-flex align-item-center">
                                            <div class="position-relative">
                                                <h6 class="profile-title">Administraction</h6>
                                                <p class="profile-date">15.3.2024</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-ucsp">See more...</button>
                                    </div>
                                </div>
                                <div class="card-body text-justify">
                                    2023-2024 ပညာသင်နှစ် ကွန်ပျူတာတက္ကသိုလ်ပြည် midterm exam များကို 21-3-2024 မှ 3.4.2024 အထိ ပြုလုပ်သွားမည်ဖြစ်ကြောင်း ကြေငြာအပ်ပါသည်။ Timetable များမှာ...
                                </div>
                            </div>

                        </div>
                    </div>
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
