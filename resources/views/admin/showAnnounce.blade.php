@extends('layouts.main')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@manageAnnounce')}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                        <h6 class="d-inline-block">Details</h6>
                    </div>
                    <div class="d-flex mt-1">
                        <div class="d-flex align-item-center">
                            <div class="position-relative">
                                <h6 class="profile-title end-0">{{Str::words(Str::after($data->name, 'Daw'), 5, '...')}} ({{$data["role"]}})</h6>
                                <p class="profile-date end-0" style="bottom: -0.8rem;">{{$data->created_at->format('D F Y')}}</p>
                            </div>
                        </div>
                        <div class="ms-2">
                            @if ($data["profile_photo_path"] == null)
                                <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                            @else
                                <img src="{{ url('storage/'.$data->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="divider bg-white m-0 p-0 mb-3"></div>

                <div class="toggle-height p-3">
                    <div class="post-header">
                        <h6 class="text-ucsp">{{$data['title']}}</h6>

                        <p class="text-justify">
                            {{$data['content']}}
                        </p>

                        <small class="mb-3"><a href="mailto:{{$data['email']}}">
                            {{$data['email']}}
                        </a></small>
                    </div>
                    <div class="bg-light rounded @if ($data['image'] == null) d-none @endif text-center my-2" style="">
                        <img src="{{asset('storage/upload/'.$data['image'])}}" alt="{{$data['image']}}" class="w-75">
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-3 offset-8">
                <a href="{{route('admin@editAnnounce', $data['id'])}}">
                    <button class="btn btn-outline-ucsp"><i class="fa fa-edit"></i> Edit</button>
                </a>
            </div>
        </div>
    </div>
@endsection
