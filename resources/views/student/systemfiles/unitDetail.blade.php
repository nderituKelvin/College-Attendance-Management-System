@extends('student.layout.layout')
@section('theTitle')
    Student - View Unit Detail
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
                                        Date
                                    </th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{ route('studentLectureDetail') }}">
                                            Finite Matter
                                        </a>
                                    </td>
                                    <td>
                                        3rd July 2017
                                    </td>
                                    <td>78 %</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ route('studentLectureDetail') }}">Finite Matter</a>
                                    </td>
                                    <td>
                                        3rd July 2017
                                    </td>
                                    <td>20%</td>
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