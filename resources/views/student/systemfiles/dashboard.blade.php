@extends('student.layout.layout')
@section('theTitle')
    Student - Home
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-school text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Units</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $totalUnits }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> {{ $percAtts }} % Attendance
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-book text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Lectures</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $totalLecs }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> {{ $percAtts }} % Attendance
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-timelapse text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Next Class in</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">
                                    @if($closestClass == null)
                                        -----
                                    @else
                                        {{ \Carbon\Carbon::parse($closestClass->time)->diffForHumans() }}
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>
                        @if($closestClass == null)
                            No Upcoming Class
                        @else
                            {{ $closestClass->title }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Upcoming Classes</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Unit
                                    </th>
                                    <th>
                                        Lecturer
                                    </th>
                                    <th>
                                        Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($upComingClasses != null)
                            @foreach($upComingClasses as $upcoming)
                                <tr>
                                    <td>
                                        {{ $upcoming->title }}
                                    </td>
                                    <td>
                                        {{ \App\Unit::where('id', $upcoming->unit)->first()->name }}
                                    </td>
                                    <td>
                                        {{ \App\User::where('id', $upcoming->lec)->first()->name }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($upcoming->time)->toFormattedDateString() }} -
                                        {{ \Carbon\Carbon::parse($upcoming->time)->toTimeString() }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
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