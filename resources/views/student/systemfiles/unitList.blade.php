@extends('student.layout.layout')
@section('theTitle')
    Student - Units
@endsection
@section('theBody')
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
                                    Lecturer
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
                                        <a href="{{ route('studentUnitDetail') }}">CIT 3304</a>

                                    </td>
                                    <td>
                                        <a href="{{ route('studentUnitDetail') }}">Automata Theorem</a>
                                    </td>
                                    <td>
                                        <img src="{{ asset('cmds/images/faces/face1.jpg') }}" class="img-md rounded-circle" alt="">
                                        Nderitu Kelvin
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