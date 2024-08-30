@extends("layouts.main")

@section("content")
<div class="container-fluid">
        <!-- main content -->
        <div class="bg-light">
            <div class="horizontal-menu py-2 mt-1 d-flex justify-content-between">
                <div class="d-flex">
                    <a href="{{route($back)}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-lg-2"></i><span class="d-none d-md-inline">Back</span></button></a>
                    <label for="announce-alert" class="form-label announce-alert bg-white rounded-pill border py-1 px-3 d-flex justify-content-center" style="margin-top: 2px;">
                        <p class="m-0 p-0">
                            <i class="bi-megaphone-fill pe-2 text-ucsp"></i>
                        </p>
                        @php
                            if(count($newNoti) == 0){
                                $new = "";
                                $alert = "";
                            } else {
                                $new = count($newNoti);
                                $index = $new - 1;
                                $alert = $newNoti[$index]["atitle"];
                            }
                        @endphp
                        <marquee direction="rtl" class="text-ucsp">{{$alert}}</marquee>
                    </label>
                </div>
                <div class="lg-profile d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="position-relative mt-1 p-2">
                            <a href="{{route('user@home')}}">
                            <i class="bi bi-bell-fill text-ucsp"></i>
                            @if ($new != "")
                                <span class="position-absolute translate-middle px-1 bg-danger border border-2 border-light rounded-pill absolute-noti fw-bold">{{$new}}</span>
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


            <div class="row g-0">
                <div class="col-sm col-lg-4 mb-3">

                    <div class="card more-rounded" style="min-height: 680px;">
                        <div class="card-body">
                            <h5 class="mb-3">Messages</h5>

                            <div class="mb-3">
                                <form action="{{route('user@startChat')}}" method="post" class="d-flex align-items-center">
                                    @csrf
                                    <div class="form-group w-100">
                                        <select name="member[]" id="choices-multiple-remove-button" multiple required>
                                          @foreach ($custom as $usr)
                                              <option value="{{ $usr['user_id'] }}">{{ $usr['user_name']." · ".$usr['dept_name'] }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-ucsp rounded-circle ms-3" style="padding: 13px 15px; margin-bottom: 15px;"><i class="fa-solid fa-plus"></i></button>
                                </form>
                            </div>

                            {{-- group folder --}}
                            @if (count($mygroup) != 0)
                            <div class="mb-3">
                                <p class="mb-2 text-ucsp text-label">Groups</p>
                                {{-- group ui --}}

                                <div class="group-scroll-content pe-2">

                                    @foreach ($mygroup as $mg)
                                        <a href="{{route('user@selectChat', $mg['gid'])}}" class="text-decoration-none text-ucsp">
                                            <div class="d-flex mb-3 chat @if ($mg->active_group) active-chat @endif">
                                                <div class="me-2">
                                                    @if ($mg->gimage == null)
                                                    <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @else
                                                    <img src="{{ asset('storage/upload/'.$mg->gimage.'') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @endif
                                                </div>
                                                <div class="position-relative w-100">
                                                    <h6 class="">
                                                        {{$mg->gname}}
                                                        <small class="chat-arrive text-muted float-end">

                                                            @if ($mg->yrnew != 0)
                                                                <span class="chat-amt badge rounded-pill bg-danger float-end">{{$mg->yrnew}}</span>
                                                            @else
                                                                <span class="btn btn-delete btn-light p-1 rounded-pill disabled">No New</span>
                                                            @endif

                                                        </small>
                                                    </h6>
                                                    <small class="message-alert text-muted w-100">
                                                        @php
                                                            $today = now();
                                                            $dd = date_diff(date_create($today), date_create($mg->lat))->format('%a');
                                                        @endphp
                                                        @if ($dd == '0')
                                                            last active in {{date_create($mg->lat)->format('H:i A')}} ago
                                                        @else
                                                            {{date_create($mg->lat)->format('M j Y H:i A (D)')}}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>

                            </div>
                            @endif

                            {{-- chat folder --}}

                            @if (count($mychat) != 0)
                            <div class="mb-3">
                                <p class="mb-2 text-ucsp text-label">Chat</p>
                                    {{-- chat ui --}}

                                    <div class="chat-scroll-content pe-2">

                                        @foreach ($mychat as $mc)
                                            <a href="{{route('user@selectChat', $mc['gid'])}}" class="text-decoration-none text-ucsp">
                                                <div class="d-flex mb-3 chat @if ($mc->active_group) active-chat @endif">
                                                    <div class="me-2">
                                                        @if ($mc->gcid == $user->id)

                                                            @if ($mc->mygimg == null)
                                                            <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                            @else
                                                            <img src="{{ url('storage/'.$mc->mygimg) }}" alt="profile" class="image-icon-size rounded-circle">
                                                            @endif
                                                        @else
                                                            @if ($mc->yrgimg == null)
                                                            <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                            @else
                                                            <img src="{{ url('storage/'.$mc->yrgimg) }}" alt="profile" class="image-icon-size rounded-circle">
                                                            @endif
                                                        @endif

                                                    </div>
                                                    <div class="position-relative w-100">
                                                        <h6 class="">
                                                            @if ($mc->gcid == $user->id)
                                                                {{$mc->mygn}}
                                                            @else
                                                                {{$mc->yrgn}}
                                                            @endif

                                                            <small class="chat-arrive text-muted float-end">
                                                                @if ($mc->yrnew != 0)
                                                                    <span class="chat-amt badge rounded-pill bg-danger float-end">{{$mc->yrnew}}</span>
                                                                @else
                                                                    <span class="btn btn-delete btn-light p-1 rounded-pill disabled">No New</span>
                                                                @endif
                                                        </small>
                                                        </h6>
                                                        <small class="message-alert text-muted w-100">
                                                            @php
                                                                $today = now();
                                                                $dd = date_diff(date_create($today), date_create($mc->lat))->format('%a');
                                                            @endphp
                                                            @if ($dd == '0')
                                                                last active in {{date_create($mc->lat)->format('H:i A')}} ago
                                                            @else
                                                                {{date_create($mc->lat)->format('M j Y H:i A (D)')}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach


                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>



                </div>

                <div class="col-sm col-lg-6 mb-3">

                    @if ($ag != null)

                        {{-- chat box --}}
                        <div class="card more-rounded" style="height: 680px;">

                            <div class="card-body">

                                {{-- chat header navbar --}}
                                <div class="d-flex justify-content-between pt-3 px-3 mb-5 shadow-sm rounded">
                                    <div class="d-flex">

                                        {{-- chat image --}}
                                        <div class="me-2 position-relative">
                                            @if ($ag->type == "mul2mul")
                                                @if ($ag->image == null)
                                                <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                @else
                                                <img src="{{ asset('storage/upload/'.$ag->image.'') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                @endif

                                                <span class="position-absolute translate-middle rounded-circle online-user"></span>
                                            @else

                                                @if ($user->id == $ag->creater_id)
                                                    @if ($ag->mygimg == null)
                                                    <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @else
                                                    <img src="{{ url('storage/'.$ag->mygimg.'') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @endif

                                                    @if ($yrinfo->status == "Online")
                                                        <span class="position-absolute translate-middle rounded-circle online-user"></span>
                                                    @elseif ($yrinfo->status == "Busy")
                                                        <span class="position-absolute translate-middle rounded-circle busy-user"></span>
                                                    @else
                                                        <span class="position-absolute translate-middle rounded-circle offline-user"></span>
                                                    @endif
                                                @else
                                                    @if ($ag->yrgimg == null)
                                                    <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @else
                                                    <img src="{{ url('storage/'.$ag->yrgimg.'') }}" alt="profile" class="image-icon-size rounded-circle border">
                                                    @endif

                                                    @if ($myinfo->status == "Online")
                                                        <span class="position-absolute translate-middle rounded-circle online-user"></span>
                                                    @elseif ($myinfo->status == "Busy")
                                                        <span class="position-absolute translate-middle rounded-circle busy-user"></span>
                                                    @else
                                                        <span class="position-absolute translate-middle rounded-circle offline-user"></span>
                                                    @endif
                                                @endif

                                            @endif

                                        </div>

                                        {{-- chat titile --}}
                                        <div class="position-relative mt-1">
                                            <h6 class="m-0 p-0">
                                                @if ($ag->type == "mul2mul")
                                                    {{$ag->name}}
                                                @else

                                                    @if ($user->id == $ag->creater_id)
                                                        {{$ag->mygn}}
                                                    @else
                                                        {{$ag->yrgn}}
                                                    @endif

                                                @endif
                                            </h6>
                                            <small class="m-0 p-0 text-muted">
                                                @if ($ag->type == "mul2mul")
                                                    active now
                                                @else
                                                    @if ($user->id == $ag->creater_id)
                                                        {{$yrinfo->status}}
                                                    @else
                                                        {{$myinfo->status}}
                                                    @endif
                                                @endif
                                            </small>
                                        </div>
                                    </div>

                                    {{-- chat sub menu --}}
                                    <div class="">
                                        @if ($ag->type == "mul2mul")
                                                <a href="tel:+9505328639">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-telephone-outbound-fill"></i>
                                                    </button>
                                                </a>
                                                <a href="mailto:ucspyayoffice@gmail.com">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-envelope-arrow-up-fill"></i>
                                                    </button>
                                                </a>
                                        @else

                                            @if ($user->id == $ag->creater_id)
                                                <a href="tel:+95{{$yrinfo->phone}}">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-telephone-outbound-fill"></i>
                                                    </button>
                                                </a>
                                                <a href="mailto:{{$yrinfo->email}}">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-envelope-arrow-up-fill"></i>
                                                    </button>
                                                </a>
                                            @else
                                                <a href="tel:+95{{$myinfo->phone}}">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-telephone-outbound-fill"></i>
                                                    </button>
                                                </a>
                                                <a href="mailto:{{$myinfo->email}}">
                                                    <button class="btn btn-ucsp rounded-circle" style="padding: 13px 14px; margin-bottom: 15px;">
                                                        <i class="bi-envelope-arrow-up-fill"></i>
                                                    </button>
                                                </a>
                                            @endif

                                        @endif
                                    </div>
                                </div>

                                {{-- chat content body --}}

                                {{-- for null conversation --}}
                                @if (count($agc) == 0)
                                    <div class="message-scroll-content">
                                        <center>
                                            @if ($ag->type == "mul2mul")
                                                @if ($ag->image == null)
                                                <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                @else
                                                <img src="{{ asset('storage/upload/'.$ag->image.'') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                @endif
                                            @else

                                                @if ($user->id == $ag->creater_id)
                                                    @if ($ag->mygimg == null)
                                                    <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                    @else
                                                    <img src="{{ url('storage/'.$ag->mygimg.'') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                    @endif
                                                @else
                                                    @if ($ag->giyrmg == null)
                                                    <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                    @else
                                                    <img src="{{ url('storage/'.$ag->yrgimg.'') }}" alt="profile" class="image-icon-size-alt rounded-circle border">
                                                    @endif
                                                @endif

                                            @endif
                                            <p class="text-muted">
                                                <small>You are now participate chat with </small>
                                                <small class="text-black fw-bold">
                                                    @if ($ag->type == "mul2mul")
                                                        {{$ag->name}}
                                                    @else

                                                        @if ($user->id == $ag->creater_id)
                                                            {{$ag->mygn}}
                                                        @else
                                                            {{$ag->yrgn}}
                                                        @endif

                                                    @endif
                                                </small>
                                            </p>
                                            <p class="text-ucsp m-0 p-0">
                                                Let get start!
                                            </p>
                                            <p class="fa-beat">...</p>
                                        </center>
                                    </div>
                                @else

                                {{-- for conversation exist --}}
                                <div class="message-scroll-content">

                                    @foreach ($agc as $msg)

                                        @if ($user->id == $ag->creater_id)

                                            @if ($ag->mid == $msg->member_id)
                                                <div class='msg msg-me mb-3'>
                                                    <h3 class='msg-me-title'>
                                                        @php
                                                            $today = now();
                                                            $dd = date_diff(date_create($today), date_create($msg->created_at))->format('%a');
                                                        @endphp
                                                        @if ($dd == '0')
                                                            {{date_create($msg->created_at)->format('H:i A')}} ago
                                                        @else
                                                            {{date_create($msg->created_at)->format('M j Y (D)')}}
                                                        @endif
                                                    </h3>
                                                    <div class='msg-me-body'>
                                                        <p class="m-0 p-0">{{$msg->message}}</p>
                                                        @if ($msg->attachment != null)
                                                            <div class="card-body p-0 m-0">
                                                                @php
                                                                    $type = Str::words(Str::after($msg->attachment, '.'), 5);
                                                                @endphp
                                                                @if ($type == "png" || $type == "jpg" || $type == "jpeg")
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none">
                                                                        <img src="{{asset('storage/upload/'.$msg->attachment.'')}}" alt="attachment" class="w-100">
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none attachment"><i class="bi bi-file-earmark-arrow-down p-2 bg-light rounded border border-info" style="font-size: 2rem;"></i></a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <img src='{{ url('storage/'.Auth::user()->profile_photo_path) }}' alt='' class='msg-me-img'>
                                                    <h3 class='msg-me-foot fw-bold'>
                                                        <span>Me</span><br>
                                                    </h3>
                                                </div>
                                            @else
                                            <div class='msg msg-box mb-3'>
                                                <h3 class='msg-box-title'>
                                                    @php
                                                        $today = now();
                                                        $dd = date_diff(date_create($today), date_create($msg->created_at))->format('%a');
                                                    @endphp
                                                    @if ($dd == '0')
                                                        {{date_create($msg->created_at)->format('H:i A')}} ago
                                                    @else
                                                        {{date_create($msg->created_at)->format('M j Y (D)')}}
                                                    @endif
                                                </h3>
                                                <div class='msg-box-body'>
                                                    <p class="">{{$msg->message}}</p>
                                                    @if ($msg->attachment != null)
                                                            <div class="card-body p-0 m-0">
                                                                @php
                                                                    $type = Str::words(Str::after($msg->attachment, '.'), 5);
                                                                @endphp
                                                                @if ($type == "png" || $type == "jpg" || $type == "jpeg")
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none">
                                                                        <img src="{{asset('storage/upload/'.$msg->attachment.'')}}" alt="attachment" class="w-100">
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none attachment"><i class="bi bi-file-earmark-arrow-down p-2 bg-light rounded border border-info" style="font-size: 2rem;"></i></a>
                                                                @endif
                                                            </div>
                                                    @endif
                                                </div>

                                                @if ($ag->image != null)
                                                    @php
                                                        $u = App\Models\GroupMember::where("id", $msg->member_id)->first();
                                                        $uinfo = App\Models\User::where("id", $u->user_id)->first();
                                                        $uinfo = json_decode($uinfo);
                                                    @endphp
                                                    <img src='{{ url('storage/'.$uinfo->profile_photo_path.'') }}' alt='' class='msg-box-img'>
                                                    <h3 class='msg-box-foot fw-bold'>
                                                        <span>{{Str::words(Str::after($uinfo->name, 'Daw'), 1, '')}}</span><br>
                                                    </h3>
                                                @else
                                                    <img src='{{ url('storage/'.$ag->mygimg.'') }}' alt='' class='msg-box-img'>
                                                    <h3 class='msg-box-foot fw-bold'>
                                                        <span>{{Str::words(Str::after($ag->mygn, 'Daw'), 1, '')}}</span><br>
                                                    </h3>
                                                @endif

                                            </div>
                                            @endif

                                        @else

                                            @if ($ag->mid == $msg->member_id)
                                                <div class='msg msg-me mb-3'>
                                                    <h3 class='msg-me-title'>
                                                        @php
                                                            $today = now();
                                                            $dd = date_diff(date_create($today), date_create($msg->created_at))->format('%a');
                                                        @endphp
                                                        @if ($dd == '0')
                                                            {{date_create($msg->created_at)->format('H:i A')}} ago
                                                        @else
                                                            {{date_create($msg->created_at)->format('M j Y (D)')}}
                                                        @endif
                                                    </h3>
                                                    <div class='msg-me-body'>
                                                        <p class="m-0 p-0">{{$msg->message}}</p>
                                                        @if ($msg->attachment != null)
                                                            <div class="card-body p-0 m-0">
                                                                @php
                                                                    $type = Str::words(Str::after($msg->attachment, '.'), 5);
                                                                @endphp
                                                                @if ($type == "png" || $type == "jpg" || $type == "jpeg")
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none">
                                                                        <img src="{{asset('storage/upload/'.$msg->attachment.'')}}" alt="attachment" class="w-100">
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none attachment"><i class="bi bi-file-earmark-arrow-down p-2 bg-light rounded border border-info" style="font-size: 2rem;"></i></a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <img src='{{ url('storage/'.Auth::user()->profile_photo_path) }}' alt='' class='msg-me-img'>
                                                    <h3 class='msg-me-foot fw-bold'>
                                                        <span>Me</span><br>
                                                    </h3>
                                                </div>
                                            @else
                                            <div class='msg msg-box mb-3'>
                                                <h3 class='msg-box-title'>
                                                    @php
                                                        $today = now();
                                                        $dd = date_diff(date_create($today), date_create($msg->created_at))->format('%a');
                                                    @endphp
                                                    @if ($dd == '0')
                                                        {{date_create($msg->created_at)->format('H:i A')}} ago
                                                    @else
                                                        {{date_create($msg->created_at)->format('M j Y (D)')}}
                                                    @endif
                                                </h3>
                                                <div class='msg-box-body'>
                                                    <p class="">{{$msg->message}}</p>
                                                        @if ($msg->attachment != null)
                                                            <div class="card-body p-0 m-0">
                                                                @php
                                                                    $type = Str::words(Str::after($msg->attachment, '.'), 5);
                                                                @endphp
                                                                @if ($type == "png" || $type == "jpg" || $type == "jpeg")
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none">
                                                                        <img src="{{asset('storage/upload/'.$msg->attachment.'')}}" alt="attachment" class="w-100">
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('storage/upload/'.$msg->attachment.'')}}" class="text-decoration-none attachment"><i class="bi bi-file-earmark-arrow-down p-2 bg-light rounded border border-info" style="font-size: 2rem;"></i></a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                </div>

                                                @if ($ag->image != null)
                                                    @php
                                                        $u = App\Models\GroupMember::where("id", $msg->member_id)->first();
                                                        $uinfo = App\Models\User::where("id", $u->user_id)->first();
                                                        $uinfo = json_decode($uinfo);
                                                    @endphp
                                                    <img src='{{ url('storage/'.$uinfo->profile_photo_path.'') }}' alt='' class='msg-box-img'>
                                                    <h3 class='msg-box-foot fw-bold'>
                                                        <span>{{Str::words(Str::after($uinfo->name, 'Daw'), 1, '')}}</span><br>
                                                    </h3>
                                                @else
                                                    <img src='{{ url('storage/'.$ag->yrgimg.'') }}' alt='' class='msg-box-img'>
                                                    <h3 class='msg-box-foot fw-bold'>
                                                        <span>{{Str::words(Str::after($ag->yrgn, 'Daw'), 1, '')}}</span><br>
                                                    </h3>
                                                @endif

                                            </div>
                                            @endif

                                        @endif

                                    @endforeach

                                </div>
                                @endif


                                {{-- typing area --}}
                                <form action="{{ route('user@sendMessage') }}" method="post" class="mt-3 px-3">
                                    @csrf
                                    <div class="row border rounded py-2">
                                        <input type="hidden" name="gid" id="gid" value="{{$ag->gid}}">
                                        <input type="hidden" name="mid" id="mid" value="{{$ag->mid}}">
                                        <input type="text" name="message" id="message" class="col-8 typing-area" required autofocus>
                                        <div class="col-4 text-end">
                                            <button type="button" class="btn btn-ucsp-none" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-image"></i></button>
                                            <button type="button" class="btn btn-ucsp-none" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fa-solid fa-paperclip"></i></button>
                                            <button class="btn btn-ucsp" type="submit">Send</button>
                                        </div>
                                    </div>
                                </form>



                            </div>

                        </div>
                    @else

                        {{-- no active chat --}}
                        <div class="my-5 text-center">
                            <div class="text-muted fs-5">
                                Oop! You have any chat to participate<br>
                                <p class="text-ucsp m-0 p-0">
                                    Let start chat!
                                </p>
                                <p class="fa-beat">...</p>

                            </div>
                        </div>

                    @endif

                </div>

                <div class="col-sm col-lg-2">

                    @if ($ag != null)

                        <div class="card more-rounded"  style="height: 680px;">

                            <div class="card-body p-0">

                                @if ($ag->type == "mul2mul")
                                    @if ($ag->image == null)
                                        <div class="position-relative" style="height: 200px; background-image: url({{asset('storage/upload/group-icon-v3.jpg')}}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                    @else
                                        <div class="position-relative" style="height: 200px; background-image: url({{asset('storage/upload/'.$ag->image.'')}}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                    @endif
                                            <div class="pp-info">
                                                <h6 class="m-0" style="font-family: 'Source Serif 4'; color: #0097b2">{{$ag->name}}</h6>
                                                <p class="m-0" style="font-size: 13px; color:#aaa">UCSP</p>
                                                <p class="m-0" style="font-size: 13px"><i class="fa-solid fa-location-dot"></i> Pyay</p>
                                                <p class="m-0">
                                                    <a href="tel:+9505328639">
                                                        <button class="btn btn-primary rounded-circle p-0">
                                                            <i class="bi-telephone-outbound-fill" style="font-size: 13px; padding: 0 5px;"></i>
                                                        </button>
                                                    </a>
                                                    <a href="sms:+9505328639">
                                                        <button class="btn btn-ucsp rounded-circle p-0">
                                                            <i class="fa-solid fa-sms px-1 py-1" style="font-size: 16px"></i>
                                                        </button>
                                                    </a>
                                                    <a href="mailto:ucspyayoffice@gmail.com">
                                                        <button class="btn btn-danger rounded-circle p-0">
                                                            <i class="bi-envelope-arrow-up-fill" style="font-size: 14px; padding: 0 5px;"></i>
                                                        </button>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>


                                        <div class="divider"></div>

                                        <div class="p-3">
                                            <h6 class="w-100">Group information <sapn class="float-end"><i class="bi-info-circle"></i></sapn></h6>
                                            <p style="font-size: 13px;">
                                                <span class="d-block text-muted">Phone</span>
                                                +95 05328639
                                            </p>
                                            <p  style="font-size: 13px;">
                                                <span class="d-block text-muted">Email</span>
                                                ucspyayoffice@gmail.com
                                            </p>
                                        </div>


                                        <div class="divider mt-0"></div>

                                        <div class="p-3">
                                            <h6 class="w-100">Created Groups <sapn class="float-end"><i class="bi-people"></i></sapn></h6>

                                            <div class="group-scroll-content-sm">
                                                {{-- @if (count($cg) == 0)

                                                    <div class="my-3 text-center">
                                                        <p class="text-muted">No group participants!</p>
                                                    </div>

                                                @else

                                                    @foreach ($cg as $r)
                                                        <div class="d-flex">
                                                            <div class="me-2">
                                                                @if ($r->image == null)
                                                                <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                @else
                                                                <img src="{{ asset('storage/upload/'.$r->image.'') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                @endif
                                                            </div>
                                                            <h6 class="text-black-50" style="font-size: 15px; padding: 8px 0px">{{Str::words($r->name, 3, '..')}}</h6>
                                                        </div>
                                                    @endforeach

                                                @endif --}}

                                                @if (count($gm) == 0)

                                                    <div class="my-3 text-center">
                                                        <p class="text-muted">No group participants!</p>
                                                    </div>

                                                @else

                                                    @foreach ($gm as $r)
                                                        <div class="d-flex my-1">
                                                            <div class="me-2">
                                                                @if ($r->uimage == null)
                                                                <img src="{{ asset('storage/upload/default-pp.png') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                @else
                                                                <img src="{{ url('storage/'.$r->uimage.'') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                @endif
                                                            </div>
                                                            <h6 class="text-black-50" style="font-size: 15px;">{{Str::words($r->uname, 3, '..')}}</h6>
                                                        </div>
                                                    @endforeach

                                                @endif


                                            </div>
                                        </div>

                                @else

                                    @if ($user->id == $ag->creater_id)

                                        @if ($ag->mygimg == null)
                                            <div class="position-relative" style="height: 200px; background-image: url({{asset('storage/upload/default-pp.png')}}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                        @else
                                            <div class="position-relative" style="height: 200px; background-image: url({{ url('storage/'.$ag->mygimg) }}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                        @endif
                                                <div class="pp-info">
                                                    <h6 class="m-0" style="font-family: 'Source Serif 4'; color: #0097b2">{{$ag->mygn}}</h6>
                                                    <p class="m-0" style="font-size: 13px; color:#aaa">{{$yrinfo->role}}</p>
                                                    <p class="m-0" style="font-size: 13px"><i class="fa-solid fa-location-dot me-2"></i>{{ $yrinfo->address }}</p>
                                                    <p class="m-0">
                                                        <a href="tel:+95{{$yrinfo->phone}}">
                                                            <button class="btn btn-primary rounded-circle p-0">
                                                                <i class="bi-telephone-outbound-fill" style="font-size: 13px; padding: 0 5px;"></i>
                                                            </button>
                                                        </a>
                                                        <a href="sms:+95{{$yrinfo->phone}}">
                                                            <button class="btn btn-ucsp rounded-circle p-0">
                                                                <i class="fa-solid fa-sms px-1 py-1" style="font-size: 16px"></i>
                                                            </button>
                                                        </a>
                                                        <a href="mailto:{{$yrinfo->email}}">
                                                            <button class="btn btn-danger rounded-circle p-0">
                                                                <i class="bi-envelope-arrow-up-fill" style="font-size: 14px; padding: 0 5px;"></i>
                                                            </button>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="divider"></div>

                                            <div class="p-3">
                                                <h6 class="w-100">Chat information <sapn class="float-end"><i class="bi-info-circle"></i></sapn></h6>
                                                <p style="font-size: 13px;">
                                                    <span class="d-block text-muted">Phone</span>
                                                    +95 {{$yrinfo->phone}}
                                                </p>
                                                <p  style="font-size: 13px;">
                                                    <span class="d-block text-muted">Email</span>
                                                    {{$yrinfo->email}}
                                                </p>
                                            </div>


                                            <div class="divider mt-0"></div>

                                            <div class="p-3">
                                                <h6 class="w-100">Group Participants <sapn class="float-end"><i class="bi-people"></i></sapn></h6>

                                                <div class="group-scroll-content-sm">
                                                    @if (count($yrpg) == 0)

                                                        <div class="my-3 text-center">
                                                            <p class="text-muted">No group participants!</p>
                                                        </div>

                                                    @else

                                                        @foreach ($yrpg as $r)
                                                            <div class="d-flex my-1">
                                                                <div class="me-2">
                                                                    @if ($r->image == null)
                                                                    <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                    @else
                                                                    <img src="{{ asset('storage/upload/'.$r->image.'') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                    @endif
                                                                </div>
                                                                <h6 class="text-black-50" style="font-size: 15px;">{{Str::words($r->name, 3, '..')}}</h6>
                                                            </div>
                                                        @endforeach

                                                    @endif


                                                </div>
                                            </div>

                                    @else


                                        @if ($ag->yrgimg == null)
                                            <div class="position-relative" style="height: 200px; background-image: url({{asset('storage/upload/default-pp.png')}}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                        @else
                                            <div class="position-relative" style="height: 200px; background-image: url({{ url('storage/'.$ag->yrgimg) }}); background-size: cover; background-position: center; border-top-left-radius: 20px;  border-top-right-radius: 20px;">
                                        @endif
                                                <div class="pp-info">
                                                    <h6 class="m-0" style="font-family: 'Source Serif 4'; color: #0097b2">{{$ag->yrgn}}</h6>
                                                    <p class="m-0" style="font-size: 13px; color:#aaa">{{$myinfo->role}}</p>
                                                    <p class="m-0" style="font-size: 13px"><i class="fa-solid fa-location-dot me-2"></i>{{ $myinfo->address }}</p>
                                                    <p class="m-0">
                                                        <a href="tel:+95{{$myinfo->phone}}">
                                                            <button class="btn btn-primary rounded-circle p-0">
                                                                <i class="bi-telephone-outbound-fill" style="font-size: 13px; padding: 0 5px;"></i>
                                                            </button>
                                                        </a>
                                                        <a href="sms:+95{{$myinfo->phone}}">
                                                            <button class="btn btn-ucsp rounded-circle p-0">
                                                                <i class="fa-solid fa-sms px-1 py-1" style="font-size: 16px"></i>
                                                            </button>
                                                        </a>
                                                        <a href="mailto:{{$myinfo->email}}">
                                                            <button class="btn btn-danger rounded-circle p-0">
                                                                <i class="bi-envelope-arrow-up-fill" style="font-size: 14px; padding: 0 5px;"></i>
                                                            </button>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="divider"></div>

                                            <div class="p-3">
                                                <h6 class="w-100">Group information <sapn class="float-end"><i class="bi-info-circle"></i></sapn></h6>
                                                <p style="font-size: 13px;">
                                                    <span class="d-block text-muted">Phone</span>
                                                    +95 {{$myinfo->phone}}
                                                </p>
                                                <p  style="font-size: 13px;">
                                                    <span class="d-block text-muted">Email</span>
                                                    {{$myinfo->email}}
                                                </p>
                                            </div>


                                            <div class="divider mt-0"></div>

                                            <div class="p-3">
                                                <h6 class="w-100">Group Participants <sapn class="float-end"><i class="bi-people"></i></sapn></h6>

                                                <div class="group-scroll-content-sm">
                                                    @if (count($mypg) == 0)

                                                        <div class="my-3 text-center">
                                                            <p class="text-muted">No group participants!</p>
                                                        </div>

                                                    @else

                                                        @foreach ($mypg as $r)
                                                            <div class="d-flex my-1">
                                                                <div class="me-2">
                                                                    @if ($r->image == null)
                                                                    <img src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                    @else
                                                                    <img src="{{ asset('storage/upload/'.$r->image.'') }}" alt="profile" class="image-icon-size-sm rounded-circle border">
                                                                    @endif
                                                                </div>
                                                                <h6 class="text-black-50" style="font-size: 15px;">{{Str::words($r->name, 3, '..')}}</h6>
                                                            </div>
                                                        @endforeach

                                                    @endif


                                                </div>
                                            </div>

                                    @endif

                                @endif

                            </div>
                        </div>

                    @endif

                </div>

            </div>

            {{-- copyright footer --}}

            <div class="text-center py-3">
                @2024 · University of Computer Studies, Pyay · &copy;Soe Htet Paing
            </div>

        </div>
</div>


{{-- error message --}}
<div class="">
    @if (\Session::has('error'))
        <div class="alert alert-danger alert-dismissable fade show position-fixed mx-3" style="right: 0; bottom: 3.2rem;">
            <div class="d-flex justify-content-between">
                <h6>
                    <strong>Error Message</strong>
                </h6>
                <h6>
                    <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
                </h6>
            </div>

            <strong>Invalid credentials! </strong>
            {{ \Session::get('error') }}
        </div>
    @endif
</div>

@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            <div class="logo d-flex">
                <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image" style="margin-top: 6.8px;">
                <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">({{Auth::user()->role}})</span></h>
            </div>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form action="{{route('user@sendMessageWithPhoto')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="gid" id="gid" value="{{$ag->gid}}">
            <input type="hidden" name="mid" id="mid" value="{{$ag->mid}}">
            <div class="form-group mb-3">
                <label class="form-label" for="msgImage"><span class="text-danger fw-bold">*</span> Browse photo</label>
                <input id="msgImage" name="msgImage" type="file" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="message"><span class="text-success fw-bold">*</span> Description</label>
                <textarea name="message" id="" cols="30" rows="3" class="form-control" placeholder="Photo description..."></textarea>
            </div>
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="sendWithPhoto" value="sendWithPhoto"><i class="fa-regular fa-paper-plane me-2"></i> Send</button>

        </div>
    </form>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            <div class="logo d-flex">
                <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image" style="margin-top: 6.8px;">
                <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp">Studcom <span class="pageuser-role">({{Auth::user()->role}})</span></h>
            </div>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form action="{{route('user@sendMessageWithFile')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="gid" id="gid" value="{{$ag->gid}}">
            <input type="hidden" name="mid" id="mid" value="{{$ag->mid}}">
            <div class="form-group mb-3">
                <label class="form-label" for="msgFile"><span class="text-danger fw-bold">*</span> Browse file</label>
                <input id="msgFile" name="msgFile" type="file" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="message"><span class="text-success fw-bold">*</span> Description</label>
                <textarea name="message" id="" cols="30" rows="3" class="form-control" placeholder="File description..."></textarea>
            </div>
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="sendWithFile" value="sendWithFile"><i class="fa-regular fa-paper-plane me-2"></i> Send</button>

        </div>
    </form>
      </div>
    </div>
</div>

@push("script")

// for multiple select
$(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
   removeItemButton: true,
   maxItemCount:1,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

});

@endpush
