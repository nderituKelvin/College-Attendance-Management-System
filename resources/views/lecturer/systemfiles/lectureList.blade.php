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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lectures as $lecture)
                                <tr>
                                    <td>
                                        <a href="{{ route('lecturerLectureDetail', ['lectureid' => $lecture->id]) }}">
                                            {{ $lecture->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('lecturerUnitDetail', ['unitid' => $lecture->unit]) }}">
                                            {{ \App\Unit::where('id', $lecture->unit)->first()->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($lecture->time)->diffForHumans() }}
                                    </td>
                                    <td>78 %</td>
                                </tr>
                                @endforeach
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