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
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($lecs as $lec)
                            <tr>
                                <td>
                                    <a href="{{ route('studentLectureDetail', ['leid' => $lec->id]) }}">
                                        {{ $lec->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($lec->time)->toFormattedDateString() }}
                                    {{ \Carbon\Carbon::parse($lec->time)->toTimeString() }}
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