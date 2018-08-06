@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - View Unit Detail
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-6 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create new Automata Theorem Lecture</h4>
                            <form method="post" class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Topic: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="3" type="text" name="topic" class="form-control" id="" placeholder="Enter Main title of next Lecture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Date: </label>
                                    <div class="col-sm-9">
                                        <input required type="date" name="date" class="form-control" id="" placeholder="Select A Date for the lecture">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Time: </label>
                                    <div class="col-sm-9">
                                        <input required type="time" name="time" class="form-control" id="" placeholder="Select Time for the lecture">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-plus-box"></i> Add Lecture</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add students to lecture:  </h4>
                            <h4 class="card-title">Upload a One Column Spreadsheet: </h4>
                            <form method="post" class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Select File: </label>
                                    <div class="col-sm-9">
                                        <input required accept=".xls, .xlsx, .csv" type="file" name="topic" class="form-control" id="" placeholder="Upload File">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-upload"></i> Upload File</button>
                            </form>
                            <br>
                            <h5>Note: The uploaded data will only consider students who have signed up</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Students in Unit</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Reg Number
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('cmds/images/faces/face1.jpg') }}" alt="" class="img img-circle">
                                </td>
                                <td>
                                    CT592-0112/2012
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lectures</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>Attendance</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('lecturerLectureDetail') }}">
                                            Finite Matter
                                        </a>
                                    </td>
                                    <td>
                                        3rd July 2017
                                    </td>
                                    <td>78 %</td>
                                    <td>
                                        <a href="" class="btn btn-success btn-xs">
                                            <i class="mdi mdi-open-in-app"></i>Start
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ route('lecturerLectureDetail') }}">Finite Matter</a>
                                    </td>
                                    <td>
                                        3rd July 2017
                                    </td>
                                    <td>20%</td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-xs">
                                            <i class="mdi mdi-open-in-app"></i>End
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('theScripts')

@endsection