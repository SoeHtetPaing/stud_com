@extends("layouts.main")

@section("content")
<div class="container-fluid">
        <!-- main content -->
        <div class="bg-light">
            <div class="horizontal-menu py-2 mt-1 d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{route($back)}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                    <label class="form-label" for="announce-alert" class="announce-alert bg-white rounded-pill border py-2 px-3 d-flex">
                        <i class="bi-megaphone-fill pe-2 text-ucsp"></i>
                        <marquee direction="rtl" class="text-ucsp">This is new announce.</marquee>
                    </label>
                </div>
                <div class="lg-profile d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="position-relative p-2">
                            <a href="{{route('user@home')}}">
                            <i class="bi bi-bell-fill text-ucsp"></i>
                            <span
                                class="position-absolute translate-middle p-1 bg-danger border border-2 border-light rounded-circle absolute-noti"></span>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-lg-inline">
                        <div class="d-flex justify-content-center mt-1 ms-5">
                            <div class="position-relative">
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


            <div class="row g-0">
                <div class="col-sm col-lg-4">

                    <div class="card more-rounded">
                        <div class="card-body">
                            <h5 class="mb-3">Messages</h5>

                            <div class="mb-3">
                                <form action="" method="get" class="d-flex align-items-center">
                                    <input type="text" name="search" id="search" class="form-control rounded-pill">
                                    <button class="btn btn-ucsp rounded-circle ms-3"><i class="fa-solid fa-plus"></i></button>
                                </form>
                            </div>

                            {{-- group & chat folder --}}
                            <div class="mb-3">
                                <p class="mb-2 text-ucsp text-label">Groups</p>
                                {{-- group ui --}}

                                <div class="group-scroll-content">

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">1CST-EC & Course Leader <small class="text-muted float-end">1:30 PM</small></h6>
                                            <small class="message-alert text-muted w-100">ကျောင်းသား အားလုံးမနက်ဖြန်ကျောင်းဝတ်စုံ ဝတ်ဖို့ ... <span class="badge rounded-pill bg-danger float-end">11</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">First year Section A <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">Hello, may i ask a question... <span class="badge rounded-pill bg-danger float-end">5</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">ပထမနှစ် ကွန်ပျူတာကျောင်းသားသီးသန့် <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">တစ်ယောက်ယောက် ရှိပါသလား?... <span class="badge rounded-pill bg-danger float-end">8</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">ပထမနှစ် ကွန်ပျူတာကျောင်းသားသီးသန့် <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">တစ်ယောက်ယောက် ရှိပါသလား?... <span class="badge rounded-pill bg-danger float-end">8</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">ပထမနှစ် ကွန်ပျူတာကျောင်းသားသီးသန့် <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">တစ်ယောက်ယောက် ရှိပါသလား?... <span class="badge rounded-pill bg-danger float-end">8</span></small>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="mb-3">
                                <p class="mb-2 text-ucsp text-label">Chats</p>
                                {{-- chat ui --}}
                                <div class="chat-scroll-content">

                                    <div class="d-flex mb-3 chat active-chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/pp-v1.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">Wai Hin Kyaw <small class="chat-arrive text-muted float-end">1:30 PM</small></h6>
                                            <small class="message-alert text-muted w-100">ကျောင်းသား အားလုံးမနက်ဖြန်ကျောင်းဝတ်စုံ ဝတ်ဖို့ ... <span class="chat-amt badge rounded-pill bg-danger float-end">11</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex mb-3 chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/pp-v10.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">Wai Yan Hein <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">Hello, may i ask a question... <span class="badge rounded-pill bg-danger float-end">5</span></small>
                                        </div>
                                    </div>

                                    <div class="d-flex chat">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/pp-v11.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <div class="position-relative w-100">
                                            <h6 class="">Chan Myae Thu <small class="text-muted float-end">12:05 PM</small></h6>
                                            <small class="message-alert text-muted w-100">တစ်ယောက်ယောက် ရှိပါသလား?... <span class="badge rounded-pill bg-danger float-end">8</span></small>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>



                </div>
                <div class="col-sm col-lg-6">

                    {{-- chat box --}}
                    <div class="card more-rounded">

                        <div class="card-body">

                            {{-- chat header navbar --}}
                            <div class="d-flex justify-content-between p-3 mb-5 shadow-sm rounded">
                                <div class="d-flex">
                                    <div class="me-2 position-relative">
                                        @if ($user->profile_photo_path == null)
                                        <img src="{{ asset('storage/upload/pp-v1.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                        @else
                                        <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                        @endif
                                        <span class="position-absolute translate-middle rounded-circle active-user"></span>
                                    </div>
                                    <div class="position-relative">
                                        <h6 class="m-0 p-0">Wai Hin Kyaw </h6>
                                        <small class="m-0 p-0 text-muted">last seen in 12:05</small>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-ucsp rounded-circle">
                                        <i class="bi-telephone-outbound-fill"></i>
                                    </button>
                                    <button class="btn btn-ucsp rounded-circle">
                                        <i class="bi-envelope-arrow-up-fill"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- chat content body --}}
                            <div class="message-scroll-content">
                                <div class='msg msg-box mb-3'>
                                    <h3 class='msg-box-title'>2024-6-20</h3>
                                    <div class='msg-box-body'>
                                        Hi
                                    </div>
                                    <img src='{{asset("storage/upload/pp-v1.jpg")}}' alt='' class='msg-box-img'>
                                    <h3 class='msg-box-foot fw-bold'>
                                        <span>Wai</span><br>
                                    </h3>
                                </div>
                                <div class='msg msg-me mb-3'>
                                    <h3 class='msg-me-title'>2024-6-20</h3>
                                    <div class='msg-me-body'>
                                        ကျောင်းသား အားလုံးမနက်ဖြန်ကျောင်းဝတ်စုံ ဝတ်ခဲ့ကြပါ... ေကျာင်းအားကစားပွဲရှိလို့ ဝတ်ခိုင်းတာ ထင်ပါတယ်...
                                    </div>
                                    <img src='{{asset("storage/upload/pp.jpeg")}}' alt='' class='msg-me-img'>
                                    <h3 class='msg-me-foot fw-bold'>
                                        <span>Soe</span><br>
                                    </h3>
                                </div>
                                <div class='msg msg-box mb-3'>
                                    <h3 class='msg-box-title'>2024-6-20</h3>
                                    <div class='msg-box-body'>
                                        Okay ပါ
                                    </div>
                                    <img src='{{asset("storage/upload/pp-v1.jpg")}}' alt='' class='msg-box-img'>
                                    <h3 class='msg-box-foot fw-bold'>
                                        <span>Wai</span><br>
                                    </h3>
                                </div>
                                <div class='msg msg-me mb-3'>
                                    <h3 class='msg-me-title'>2024-6-20</h3>
                                    <div class='msg-me-body'>
                                        ကျောင်းသား အားလုံးမနက်ဖြန်ကျောင်းဝတ်စုံ ဝတ်ခဲ့ကြပါ... ေကျာင်းအားကစားပွဲရှိလို့ ဝတ်ခိုင်းတာ ထင်ပါတယ်...
                                    </div>
                                    <img src='{{asset("storage/upload/pp.jpeg")}}' alt='' class='msg-me-img'>
                                    <h3 class='msg-me-foot fw-bold'>
                                        <span>Soe</span><br>
                                    </h3>
                                </div>
                            </div>

                            {{-- typing area --}}
                            <form action="" method="post" class="mt-3 px-3">
                                <div class="row border rounded py-2">
                                    <input type="text" name="message" id="message" class="col-8 typing-area" autofocus>
                                    <div class="col-4 text-end">
                                        <button class="btn btn-ucsp-none"><i class="fa-solid fa-image"></i></button>
                                        <button class="btn btn-ucsp-none"><i class="fa-solid fa-paperclip"></i></button>
                                        <button class="btn btn-ucsp" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>



                        </div>

                    </div>
                </div>

                <div class="col-sm col-lg-2">
                    <div class="card more-rounded">
                        <div class="card-body p-0">
                            <div class="position-relative" style="height: 200px; background-image: url({{asset('storage/upload/pp-v1.jpg')}}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                <div class="pp-info">
                                    <h6 class="m-0" style="font-family: 'Source Serif 4'; color: #0097b2">Wai Hin Kyaw</h6>
                                    <p class="m-0" style="font-size: 13px; color:#aaa">Final year</p>
                                    <p class="m-0" style="font-size: 13px"><i class="fa-solid fa-location-dot"></i> Pyay</p>
                                    <p class="m-0">
                                        <button class="btn btn-primary rounded-circle p-0">
                                            <i class="bi-telephone-outbound-fill px-1" style="font-size: 13px"></i>
                                        </button>
                                        <button class="btn btn-ucsp rounded-circle p-0">
                                            <i class="fa-solid fa-sms px-1" style="font-size: 15px"></i>
                                        </button>
                                        <button class="btn btn-danger rounded-circle p-0">
                                            <i class="bi-envelope-arrow-up-fill px-1" style="font-size: 14px"></i>
                                        </button>
                                    </p>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="p-3">
                                <h6 class="w-100">User information <sapn class="float-end"><i class="bi-info-circle"></i></sapn></h6>
                                <p style="font-size: 13px;">
                                    <span class="d-block text-muted">Phone</span>
                                    +099679679679
                                </p>
                                <p  style="font-size: 13px;">
                                    <span class="d-block text-muted">Email</span>
                                    waihinkyaw@gmail.com
                                </p>
                            </div>


                            <div class="divider mt-0"></div>

                            <div class="p-3">
                                <h6 class="w-100">Group Participants <sapn class="float-end"><i class="bi-people"></i></sapn></h6>

                                <div class="group-scroll-content-sm">

                                    <div class="d-flex">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <h6 class="text-ucsp" style="font-size: 13px; padding: 8px 0px">First year Section A</h6>
                                    </div>

                                    <div class="d-flex">
                                        <div class="me-2">
                                            @if ($user->profile_photo_path == null)
                                            <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                            @else
                                            <img src="{{ asset('storage/upload/pp.jpeg') }}" alt="profile" class="profile-icon rounded-circle">
                                            @endif
                                        </div>
                                        <h6 class="text-ucsp" style="font-size: 13px; padding: 8px 0px">ပထမနှစ် ကွန်ပျူတာ...</h6>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- copyright footer --}}

            <div class="text-center py-3">
                @2024 · University of Computer Studies, Pyay · &copy;Genius iQ
            </div>

        </div>
</div>
@endsection
