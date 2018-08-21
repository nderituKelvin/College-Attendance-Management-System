@extends('student.layout.layout')
@section('theTitle')
    Student - Lecture Detail
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Unit: {{ $unit->name }}</h2>
            <h4>Lecture: {{ $lecture->title }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(\App\Attendance::where('student', \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())->where('lec', $lecture->id)->count() == 0)
                                <a href="{{ route('studentSignAttendance', ['leid' => $lecture->id]) }}" class="btn btn-outline btn-success btn-block">
                                    Sign In
                                </a>
                            @else
                                <button disabled="" class="btn btn-outline btn-info btn-block">
                                    Signed In
                                </button>
                            @endif


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
                            <h4 class="card-title">Learning Materials - Click to Download</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        File
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $material)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/materials/'.$material->file) }}">
                                            {{ $material->title }}
                                        </a>
                                    </td>
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