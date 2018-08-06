@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - View Lectures
@endsection
@section('theBody')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
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
                                        Unit
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Attendance
                                    </th>
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
                                        <a href="{{ route('lecturerUnitDetail') }}">
                                            Automata Theorem
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
                                        Automata Theorem
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