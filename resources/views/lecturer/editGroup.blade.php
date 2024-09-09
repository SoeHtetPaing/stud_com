@extends('layouts.main-clone')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">

        <div class="d-flex justify-content-between align-items-center pt-3 px-md-5 mb-2">
            <div class="">
                <a href="{{ route('lecturer@group') }}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
            </div>
            <div class="d-flex align-items-center">
                <div class="mt-2">
                    <h6 class="text-ucsp">Group Managements</h6>
                </div>
                <div class="ms-2">
                    <img src="{{asset('img/favicon/ucsp.jpg')}}" alt="ucsp-logo" class="profile-icon rounded-circle">
                </div>
            </div>
        </div>
        <div class="divider bg-white m-0 p-0 mx-md-5 mb-3"></div>

        <div class="row mx-md-5">

            <div class="col-sm col-md-6 py-3">

                <div class="d-flex mt-1 mb-3">
                    <div class="">
                        @if ($data["image"] == null)
                        <img style="cursor: pointer;" src="{{ asset('storage/upload/group-icon-v3.jpg') }}" alt="profile" class="logo-icon rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        @else
                        <img style="cursor: pointer;" src="{{ asset('storage/upload/'.$data->image) }}" alt="profile" class="logo-icon rounded-circle" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        @endif
                    </div>
                    <div class="d-flex align-item-center position-relative">
                        <div class="position-absolute ms-3 bottom-0">
                            <h6 class="text-ucsp m-0 p-0 py-1" style="font-size: 12px;">
                                AUTO GENERATED
                            </h6>
                            <h6 class="">UCSP@GROUP#{{$data->id}}</h6>
                        </div>
                    </div>
                </div>

                <form action="{{route('lecturer@updateGroup')}}" method="POST" enctype="multipart/form-data" class="me-3">
                    @csrf

                    <input class="form-control" type="hidden" name="groupId" id="groupId" value="{{$data['id']}}">

                    <div class="form-group mb-3">
                      <label class="form-label" for="groupName"><span class="text-danger fw-bold">*</span> Group name</label>
                      <input type="text" name="groupName" class="form-control" required="" value="{{$data['name']}}">
                    </div>

                    <div class="form-group mb-3 text-end">
                      <input type="submit" value="Update Name" name="updateGroup" class="btn btn-ucsp">
                    </div>

                </form>

                <div class="bg-student rounded me-3 p-3" style="height: 428px; overflow-y: scroll;">
                    <span class="text-danger">* Click photo to update group avatar picture!</span>

                    {{-- message --}}
                    @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp my-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                    @endif

                    @if (\Session::has('error'))
                        <div class="bg-white rounded border border-danger py-2 px-3 text-danger my-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                    @endif

                    @isset($msg)
                        @foreach ($msg as $m)
                            <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp my-3"><i class="bi bi-check-all me-2"></i>{{ $m }}</div>
                        @endforeach
                    @endisset

                    @isset($errors)
                        @foreach ($errors as $e)
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger my-3"><i class="bi bi-x me-2"></i>{{ $e }}</div>
                        @endforeach
                    @endisset
                </div>

            </div>

            <div class="col-sm col-md-6 bg-white rounded" style="height: 675px; overflow-y: scroll;">

                @if (count($member) == 0)
                   <div class="my-5 text-center">
                       <div class="text-muted fs-5">
                           Oop! No data found<br>
                           <i class="fs-3 mt-5 fa-solid fa-bomb fa-beat"></i>
                       </div>
                   </div>
                @else

                    <div class="bg-white pt-3 rounded" style="position: sticky; top: 0; z-index: 11;">
                        <div class="d-flex justify-content-between mx-2">
                            <h6 class="text-ucsp">Member Lists <span class="text-black-50">(Totals: <span class="text-black fw-bold">{{count($member)}}</span>)</span></h6>
                            <h6 class="position-relative">
                                <button class="btn btn-sm btn-ucsp rounded-circle" style="width: 25px; height: 25px;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus position-absolute" style="top: 27%; right: 28%; font-size: 12px;"></i></button>
                            </h6>
                        </div>
                        <div class="divider bg-light m-0 p-0 mx-1"></div>
                    </div>

                    <table class="table table-hover px-3" style="text-align: left;">
                   @foreach ($member as $r )
                        <tr>
                            <td>
                                @if ($r["profile_photo_path"] == null)
                                <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                @else
                                <img src="{{ url('storage/'.$r->profile_photo_path) }}" alt="profile" class="profile-icon rounded-circle">
                                @endif
                            </td>
                            <td class="w-75" style="vertical-align: middle;">
                                {{$r->user_name}}
                                @if ($r['gendar'] == "Male")
                                    <i class="fa-solid fa-mars text-warning ms-3"></i>
                                @else
                                    <i class="fa-solid fa-venus ms-3" style="color: deeppink;"></i>
                                @endif
                            </td>
                            <td style="text-align: right; vertical-align: middle;">
                                @if ($r->user_id == $data->creater_id)
                                <button class="btn btn-sm btn-light" title="Admin"><i class="fa-solid fa-user-tie text-ucsp" style="font-size: 16px;"></i></button>
                                @else
                                <a onclick="return confirm('Are you sure to remove this member?')" href="{{route('admin@removeMember', $r['id'])}}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-delete btn-danger"><i class="fa fa-trash"></i></button>
                                </a>
                                @endif
                            </td>
                        </tr>

                   @endforeach
                </table>

                @endif
            </div>

        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Member Enroll to UCSP@GROUP#{{$data->id}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('lecturer@addMember')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input class="form-control" type="hidden" name="groupId" id="groupId" value="{{$data['id']}}">

            <div class="form-group mb-3">
                <label class="form-label" for="choices-multiple-remove-button"><span class="text-danger fw-bold">*</span> Search & select enroll members</label>
                <select name="member[]" id="choices-multiple-remove-button" multiple>
                  @foreach ($custom as $usr)
                      <option value="{{ $usr['user_id'] }}">{{ $usr['user_name']." · ".$usr['dept_name'] }}</option>
                  @endforeach
              </select>
              </div>
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="submit" value="Add Member"><i class="fa fa-circle-plus me-2"></i> Enroll</button>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Group Photo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    <form action="{{route('admin@updateGroupPhoto')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input class="form-control" type="hidden" name="gid" id="gid" value="{{$data['id']}}">
            <label class="form-label" for="groupImage"><span class="text-success fw-bold">*</span> Select new group photo</label>
            <input id="groupImage" name="groupImage" type="file" class="form-control">
        </div>
        <div class="modal-footer border-top-none">
            <button class="btn btn-outline-ucsp" type="submit" name="submit"value="Update"><i class="fa fa-upload me-2"></i> Update</button>
            <button class="btn btn-delete btn-danger" type="submit" name="submit" value="Remove"><i class="fa fa-trash me-2"></i> Remove</button>

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
   maxItemCount:50,
   searchResultLimit:10,
   renderChoiceLimit:5
 });

});
@endpush
