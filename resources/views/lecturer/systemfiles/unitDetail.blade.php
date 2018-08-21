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
                            <h4 class="card-title">Schedule new <u><b>{{ $unit->name }}</b></u> Lecture</h4>
                            <form method="post" action="{{ route('postAddLecture') }}" class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Topic: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="3" type="text" name="title" class="form-control" id="" placeholder="Enter Main title of next Lecture">
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
                                <input type="hidden" value="{{ $unit->id }}" name="unit">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-plus-box"></i> Add Lecture</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add students to lecture:  </h4>
                            <h4 class="card-title" style="color: #ff0000"> <b><u>NOTE: Upload a One Column Spreadsheet of Student Rgistration Numbers only:</u></b> </h4>
                            <form method="post" action="{{ route('postAddStudents') }}" class="forms-sample" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Select File: </label>
                                    <div class="col-sm-9">
                                        <input required accept=".xls, .xlsx, .csv" type="file" name="excelFile" class="form-control" id="" placeholder="Upload File">
                                    </div>
                                </div>
                                <input type="hidden" name="unit" value="{{ $unit->id }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-upload"></i> Upload File</button>
                            </form>
                            <br>
                            <h5>Note: The uploaded data will only consider students who have signed up</h5>
                            <h5>To refresh the list, upload the spread sheet again</h5>
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
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/images/'.\App\Photo::where('native', 'user')->where('nativeid', $student->student)->first()->name) }}" alt="" class="img img-circle">
                                </td>
                                <td>
                                    {{ \App\User::where('id', $student->student)->first()->regno }}
                                </td>
                            </tr>
                            @endforeach
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
                                        {{ \Carbon\Carbon::parse($lecture->time)->toFormattedDateString() }}
                                        {{ \Carbon\Carbon::parse($lecture->time)->toTimeString() }}
                                    </td>
                                    <td>
                                        @if(\App\Reg::where('unit', $lecture->unit)->count() != 0)
                                        {{ (\App\Attendance::where('lec', $lecture->id)->where('unit', $lecture->unit)->count() / \App\Reg::where('unit', $lecture->unit)->count() ) * 100 }}
                                        @else
                                            0
                                        @endif
                                        %</td>
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