@extends('layouts.main-clone')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@manageUser')}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                        <h6 class="d-inline-block">Update</h6>
                    </div>
                    <div class="d-flex mt-1">
                        <div class="d-flex align-item-center">
                            <div class="position-relative profile-group">
                                <h6 class="profile-title end-0">{{Str::words(Str::after($data->name, 'Daw'), 5, '...')}}</h6>
                                <p class="profile-date end-0" style="bottom: -0.8rem;">
                                    {{$data["role"]}}
                                    @if ($data['gendar'] == "Male")
                                        <i class="fa-solid fa-mars text-warning"></i>
                                    @else
                                        <i class="fa-solid fa-venus" style="color: deeppink;"></i>
                                    @endif
                                </p>
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

                <form action="{{route('admin@updateUser')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="toggle-height p-3">

                        {{-- message --}}
                        @if (\Session::has('message'))
                        <div class="bg-white rounded border-ucspyay py-2 px-3 text-ucsp mb-3"><i class="bi bi-check-all me-2"></i>{{ \Session::get('message') }}</div>
                        @endif
                        @if (\Session::has('error'))
                            <div class="bg-white rounded border border-danger py-2 px-3 text-danger mb-3"><i class="bi bi-x me-2"></i>{{ \Session::get('error') }}</div>
                        @endif

                        <input class="form-control" type="hidden" name="user_id" id="user_id" value="{{$data['id']}}">

                        <div class="form-group mb-3">
                            <label class="form-label" for="name"><span class="text-danger fw-bold">*</span> Name</label>
                            <input type="text" name="name" class="form-control" required="" value="{{$data['name']}}">
                          </div>
                          <div class="form-group mb-3">
                              <label class="form-label" for="email"><span class="text-danger fw-bold">*</span> Email</label>
                              <input type="email" name="email" class="form-control" required="" value="{{$data['email']}}">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="role"><span class="text-danger fw-bold">*</span> Current role</span></label>
                            @php
                                $r = ["Admin", "Lecturer", "EC Student", "Student", "Granduate"];
                            @endphp
                            <select name="role" id="role" class="form-select">
                                    @php
                                        foreach ($r as $temp) {
                                            $selected = "";
                                            if ($temp == $data['role']) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="'.$temp.'" '.$selected.'>'.$temp.'</option>';

                                        }

                                    @endphp

                            </select>
                          </div>

                          <div class="form-group mb-3">
                              <label class="form-label" for="dept"><span class="text-danger fw-bold">*</span> Current Department</label>
                              <select name="dept" id="dept" class="form-select">
                                  @foreach($dept as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $data["dept_id"]) selected @endif>{{ $item->name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          @php
                              if ($data["section"] != "") {
                            @endphp
                                <div class="form-group mb-3">
                                <label class="form-label" for="section"><span class="text-danger fw-bold">*</span> Current section</span></label>
                            @php
                                $r = ["Section A", "Section B", "Section C", "Section CT"];
                            @endphp
                            <select name="section" id="section" class="form-select">
                                    @php
                                        foreach ($r as $temp) {
                                            $selected = "";
                                            if ($temp == $data['section']) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="'.$temp.'" '.$selected.'>'.$temp.'</option>';

                                        }

                                    @endphp

                            </select>
                          </div>
                          @php
                              }
                          @endphp

                          <div class="form-group mb-3">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Male" @if ($data['gendar'] == "Male")  checked @endif>
                                  <label class="form-check-label" for="gendar">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="gendar" id="gendar" value="Female" @if ($data['gendar'] == "Female")  checked @endif>
                                  <label class="form-check-label" for="inlineRadio2">Female</label>
                              </div>
                          </div>
                          <div class="form-group mb-3">
                                <label class="form-label" for="lectPassword"><span class="text-danger fw-bold">*</span> Reset password, click <span class="btn-delete bg-danger text-white rounded py-1 px-2 ms-1"><i class="fa-solid fa-power-off me-1"></i> Reset</span>
                                    <br>
                                    <table class="table table-hover mt-3">
                                        <tr>
                                            <th>Role</th>
                                            <th>Reset Password</th>
                                        </tr>
                                        <tr>
                                            <td>Admin</td>
                                            <td>admin@ucsp</td>
                                        </tr>
                                        <tr>
                                            <td>Lecturer</td>
                                            <td>lecturer@ucsp</td>
                                        </tr>
                                        <tr>
                                            <td>Student</td>
                                            <td>student@ucsp</td>
                                        </tr>
                                    </table>
                                    <span class="text-danger">This is individually password reset! Not for all.</span>
                                </label>
                            </div>
                    </div>

                    <div class="form-group mt-3 text-end">
                        <button type="submit" name="submit" value="Reset" class="btn btn-delete btn-danger"><i class="fa-solid fa-power-off me-2"></i> Reset</button>
                        <button type="submit" name="submit" value="Update" class="btn btn-outline-ucsp"><i class="fa-solid fa-check me-2"></i> Update</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
