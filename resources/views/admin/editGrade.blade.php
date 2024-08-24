@extends('layouts.main')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@manageGrade')}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                        <h6 class="d-inline-block">Update</h6>
                    </div>
                    <div class="d-flex mt-1">
                        <div class="d-flex align-item-center">
                            <div class="position-relative">
                                <h6 class="profile-title end-0">{{Str::words(Str::after($data->creater_name, 'Daw'), 5, '...')}}</h6>
                                <p class="profile-date end-0" style="bottom: -0.8rem;">ANOID:GD2ANO#{{$data["id"]."".$data["group_id"]."".$data["member_id"]}}</p>
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

                <form action="{{route('admin@updateGrade')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-3">

                        <input class="form-control" type="hidden" name="cid" id="cid" value="{{$data['id']}}">

                        <div class="form-group mb-3">
                            <label class="form-label" for="message"><span class="text-danger fw-bold">*</span> Notice Message</label>
                            <input type="text" name="message" class="form-control" required="" value="{{$data['message']}}">
                        </div>
                          @if ($data['attachment'] == null)
                          <div class="form-group mb-3">
                              <label class="form-label" for="attachment"><span class="text-danger fw-bold">*</span> Select grade attachment file</label>
                              <input type="file" name="attachment" class="form-control" required="">
                          </div>
                          @else
                          <div class="row">
                            <div class="col col-md-4">
                                <div class="position-relative bg-student border rounded" style="height: 150px;">
                                    <div class="position-absolute" style="top: 48%; left: 28%" title="Click file to view result">
                                        @php
                                            $type = Str::words(Str::after($data->attachment, '.'), 5);
                                        @endphp
                                        @if ($type == "pdf")
                                            <a href="{{asset('storage/upload/'.$data->attachment.'')}}" class="text-decoration-none attachment" style="font-size: 4rem;"><i class="fa-regular fa-file-pdf fa-lg me-1"></i></a>
                                        @else
                                            <a href="{{asset('storage/upload/'.$data->attachment.'')}}" class="text-decoration-none attachment" style="font-size: 4rem;"><i class="fa-regular fa-file-image fa-lg me-2"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-8">
                                <br><br>
                                <button class="btn btn-delete btn-danger mt-2 mb-3 d-block" type="submit" name="submit" value="Remove"><i class="fa fa-trash me-2"></i> Remove File</button>
                                <button class="btn btn-outline-ucsp d-block pe-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-upload me-2"></i> Update File</button>
                            </div>
                          </div>

                          @endif
                    </div>

                    <div class="form-group mt-3 text-end me-3">
                        <button type="submit" name="submit" value="Update" class="btn btn-outline-ucsp"><i class="fa-solid fa-check me-2"></i> Update</button>
                    </div>
                </form>

                <div class="mt-5 p-3">
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
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Grade Announce File</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form action="{{route('admin@updateGradeFile')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input class="form-control" type="hidden" name="cid" id="cid" value="{{$data['id']}}">
            <label class="form-label" for="gradeFile"><span class="text-success fw-bold">*</span> Select new grade file</label>
            <input id="gradeFile" name="gradeFile" type="file" class="form-control">
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="updateAnnouncePhoto"><i class="fa fa-upload me-2"></i> Update</button>
        </div>
    </form>
      </div>
    </div>
</div>
