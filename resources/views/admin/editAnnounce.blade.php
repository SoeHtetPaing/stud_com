@extends('layouts.main')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@showAnnounce', ["id" => $data['id']])}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                        <h6 class="d-inline-block">Update</h6>
                    </div>
                    <div class="d-flex mt-1">
                        <div class="d-flex align-item-center">
                            <div class="position-relative">
                                <h6 class="profile-title end-0">{{Str::words(Str::after($data->name, 'Daw'), 5, '...')}} ({{$data["role"]}})</h6>
                                <p class="profile-date end-0" style="bottom: -0.8rem;">{{$data->created_at->format('D F Y')}}</p>
                            </div>
                        </div>
                        <div class="ms-2">
                            @if ($data["profile_photo"] == null)
                            <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                            @else
                            <img src="{{ asset('storage/upload/'.$data->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="divider bg-white m-0 p-0 mb-3"></div>

                <form action="{{route('admin@updateAnnounce')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="toggle-height p-3">

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp mb-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger mb-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                        <input class="form-control" type="hidden" name="announce_id" id="announce_id" value="{{$data['id']}}">

                        <div class="form-group mb-3">
                            <label class="form-label" for="annoTitle"><span class="text-danger fw-bold">*</span> Announcement title</label>
                            <input type="text" name="annoTitle" class="form-control" required="" value="{{$data['title']}}">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="annoContent"><span class="text-danger fw-bold">*</span> Announcement content</label>
                            <textarea name="annoContent" id="" cols="30" rows="8" class="form-control" required="">{{$data['content']}}</textarea>
                          </div>
                          @if ($data['image'] == null)
                          <div class="form-group mb-3">
                              <label class="form-label" for="annoImage"><span class="text-success fw-bold">*</span> Announcement photo is optional</label>
                              <input type="file" name="annoImage" class="form-control">
                          </div>
                          @else
                          <label class="form-label" for="annoImage"><span class="text-success fw-bold">*</span> Click image to update photo</label>

                          <div class="bg-light rounded text-center">
                              <img style="cursor: pointer;" src="{{asset('storage/upload/'.$data['image'])}}" alt="{{$data['image']}}" class="w-75" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          </div>

                          @endif
                    </div>

                    <div class="form-group mt-3 text-end">
                        <button type="submit" class="btn btn-outline-ucsp"><i class="fa-solid fa-check me-2"></i> Update</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Announcement Photo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form action="{{route('admin@updateAnnouncePhoto')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input class="form-control" type="hidden" name="announce_id" id="announce_id" value="{{$data['id']}}">
            <label class="form-label" for="annoImage"><span class="text-success fw-bold">*</span> Select new announce photo</label>
            <input id="annoImage" name="annoImage" type="file" class="form-control">
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="submit"value="Update"><i class="fa fa-upload me-2"></i> Update</button>
            <button class="btn btn-delete btn-danger" type="submit" name="submit" value="Remove"><i class="fa fa-trash me-2"></i> Remove</button>

        </div>
    </form>
      </div>
    </div>
</div>
