@extends('layouts.main-clone')

@section('content')
    <div class="container" style="min-height: 100vh; background-color: rgba(0, 151, 178, 0.025)">
        <div class="row">

            <div class="col-sm col-md-8 offset-md-2 col-lg-6 offset-lg-3 p-3">

                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                    <div class="">
                        <a href="{{route('admin@manageDepartment')}}"><button class="btn btn-ucsp me-3 my-1"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                    </div>
                    <div class="">
                        <h6 class="text-ucsp">Update Department</h6>
                    </div>
                </div>

                <div class="divider bg-white m-0 p-0 mb-3"></div>

                <div class="text-center my-5">
                    <img src="{{asset('img/favicon/ucsp.jpg')}}" alt="ucsp-logo" class="logo-icon rounded-circle">
                    <h6 class="text-ucsp mt-3">Department in University of Computer Studies, Pyay</h6>
                </div>

                <form action="{{route('admin@updateDepartment')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input class="form-control" type="hidden" name="deptId" id="deptId" value="{{$data['id']}}">

                    <div class="form-group mb-3">
                        <label class="form-label" for="year"><span class="text-danger fw-bold">*</span> Department ID (Auto Generated)</label>
                        <input type="text" name="deptShowId" class="form-control disabled" required="" value="UCSP@DEPT#{{$data['id']}}" readonly>
                    </div>

                    <div class="form-group mb-3">
                      <label class="form-label" for="deptName"><span class="text-danger fw-bold">*</span> Department name</label>
                      <input type="text" name="deptName" class="form-control" required="" value="{{$data['name']}}">
                    </div>

                    <div class="form-group mb-3 text-end">
                      <input type="submit" value="Update Department" name="updateDepartment" class="btn btn-ucsp">
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection
