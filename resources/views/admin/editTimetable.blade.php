@extends('layouts.main-clone')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@manageTimetable')}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                    </div>
                    <div class="">
                        <h6 class="text-ucsp">Update Timetable Schedule</h6>
                    </div>
                </div>

                <div class="divider bg-white m-0 p-0 mb-3"></div>

                <form action="{{route('admin@updateTimetable')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input class="form-control" type="hidden" name="tid" id="tid" value="{{$data['id']}}">

                    <div class="form-group mb-3">
                        <label class="form-label" for="year"><span class="text-danger fw-bold">*</span> Current academic year</label>
                        <select name="year" id="year" class="form-select">
                            @foreach($stuDept as $item)
                                @php
                                    if($data["department_id"] == $item->id){
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                @endphp
                              <option value="{{ $item->id }}" {{$selected}}>{{ $item->name }}</option>
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


                    @php
                          if ($data["day"] != "") {
                        @endphp
                            <div class="form-group mb-3">
                            <label class="form-label" for="day"><span class="text-danger fw-bold">*</span> Current day</span></label>
                        @php
                            $r = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
                        @endphp
                        <select name="day" id="day" class="form-select">
                                @php
                                    foreach ($r as $temp) {
                                        $selected = "";
                                        if ($temp == $data['day']) {
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
                        <label class="form-label" for="startHour"><span class="text-danger fw-bold">*</span> Current time interval</label>
                        <div class="row">
                            <div class="col">
                                @php
                                  if ($data["start_hour"] != "") {
                                    $r = ["9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM", "2:00 PM", "3:00 PM"];
                                @endphp
                                <select name="startHour" id="startHour" class="form-select">
                                        @php
                                            foreach ($r as $temp) {
                                                $selected = "";
                                                if ($temp == $data['start_hour']) {
                                                    $selected = "selected";
                                                }
                                                echo '<option value="'.$temp.'" '.$selected.'>'.$temp.'</option>';
                                            }
                                        @endphp
                                </select>
                                @php
                                    }
                                @endphp
                            </div>
                            <div class="col">
                                @php
                                  if ($data["start_hour"] != "") {
                                    $r = ["10:00 AM", "11:00 AM", "12:00 PM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM"];
                                @endphp
                                <select name="endHour" id="endHour" class="form-select">
                                        @php
                                            foreach ($r as $temp) {
                                                $selected = "";
                                                if ($temp == $data['end_hour']) {
                                                    $selected = "selected";
                                                }
                                                echo '<option value="'.$temp.'" '.$selected.'>'.$temp.'</option>';
                                            }
                                        @endphp
                                </select>
                                @php
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="choices-multiple-remove-button"><span class="text-danger fw-bold">*</span> Search & select a subject</label>
                        <select name="subject[]" id="choices-multiple-remove-button" required="" multiple>
                          @foreach ($subject as $sub)
                                @php
                                    if($data["subject_code"] == $sub["subject_code"] && $data["subject_name"] == $sub["subject_name"]){
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                @endphp
                              <option value="{{ $sub['id'] }}" {{$selected}}>{{ $sub['subject_code']." · ".$sub['subject_name'] }}</option>
                          @endforeach
                      </select>
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="choices-multiple-remove-button-1"><span class="text-danger fw-bold">*</span> Search & select lecturer</label>
                        <select name="lecturer[]" id="choices-multiple-remove-button-1" required="" multiple>
                            @foreach ($lecturer as $lect)
                                @php
                                    if($data["lecturer_name"] == $lect["user_name"]){
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                @endphp
                            <option value="{{ $lect['user_name'] }}" {{$selected}}>{{ $lect['user_name']." · ".$lect['dept_name'] }}</option>
                            @endforeach
                      </select>
                      </div>
                    <div class="form-group mb-3 text-end">
                      <input type="submit" value="Update a schedule" name="addTimetable" class="btn btn-ucsp">
                    </div>
                </form>


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
