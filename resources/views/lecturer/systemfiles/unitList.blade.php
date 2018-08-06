@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - Home
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Unit</h4>
                            <form method="post" class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Unit Code: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="3" type="text" name="unitcode" class="form-control" id="" placeholder="Enter Unit Code Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Unit Name: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="4" type="text" name="unitname" class="form-control" id="" placeholder="Unit Name">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-plus-box"></i> Add Unit</button>
                                <button class="btn btn-light reset">Cancel</button>
                            </form>
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
                    <h4 class="card-title">Units</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Unit Code
                                </th>
                                <th>
                                    Unit Title
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Average Attendance
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('lecturerUnitDetail') }}">CIT 3304</a>

                                    </td>
                                    <td>
                                        <a href="{{ route('lecturerUnitDetail') }}">Automata Theorem</a>
                                    </td>
                                    <td>
                                       <button class="btn btn-xs btn-success disabled">Active</button>
                                    </td>
                                    <td>
                                        30 %
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        Pagination Here
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('theScripts')

@endsection