@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - Lecture Detail
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Unit: Automata Theorem</h2>
            <h4>Lecture: Finite Matter</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-outline btn-success btn-block">
                                Start Lecture
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline btn-danger btn-block">
                                End Lecture
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Attendance - 40 students (70%)</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-md btn-info">Submit Attendance List</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Registration Number
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Signed
                                </th>
                                <th>
                                    Revoke Signing
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
                                    <td>
                                        Nderitu Kelvin
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-rounded btn-success" disabled="" href="">
                                            <i class="mdi mdi-check-circle"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="mdi mdi-cancel"></i> Revoke
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('cmds/images/faces/face1.jpg') }}" alt="" class="img img-circle">
                                    </td>
                                    <td>
                                        CT592-0112/2012
                                    </td>
                                    <td>
                                        Nderitu Kelvin
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-rounded btn-danger" disabled="" href="">
                                            <i class="mdi mdi-sign-caution"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="mdi mdi-cancel"></i> Revoke
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
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Post Lecture Learning Material Here</h4>
                    <form method="post" class="forms-sample">
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Title: </label>
                            <div class="col-sm-9">
                                <input required minlength="5" type="text" name="topic" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Select File : </label>
                            <div class="col-sm-9">
                                <input required type="file" name="material" class="form-control" id="">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-upload-multiple"></i> Upload Material</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Learning Materials - Click to Download</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        Remove
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <a href="">
                                            Infinate matter encapsulation
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-danger">
                                            <i class="mdi mdi-delete"></i>Remove
                                        </button>
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