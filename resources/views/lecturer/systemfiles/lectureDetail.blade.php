@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - Lecture Detail
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Unit: {{ $unit->name }}</h2>
            <h4>Lecture: {{ $lecture->title }}</h4>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Attendance -
                                @if( \App\Attendance::where('lec', $lecture->id)->where('unit', $lecture->unit)->count() != 0)
                                    {{ \App\Attendance::where('lec', $lecture->id)->where('unit', $lecture->unit)->count() }}
                                @else
                                    0
                                @endif
                                student(s) (
                                @if(\App\Reg::where('unit', $lecture->unit)->count() != 0)
                                {{ (\App\Attendance::where('lec', $lecture->id)->where('unit', $lecture->unit)->count() / \App\Reg::where('unit', $lecture->unit)->count() ) * 100 }}
                                @else
                                0
                                @endif
                                    %)</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('closeSigning', ['lecid' => $lecture->id]) }}" class="btn btn-md btn-info">Close Signing</a>
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
                            @foreach(\App\Reg::where('unit', $lecture->unit)->get() as $reg)
                                <?php $student = \App\User::where('id', $reg->student)->first() ?>
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/images/'.\App\Photo::where('native', 'user')->where('nativeid', $student->id)->first()->name) }}" alt="" class="img img-circle">
                                    </td>
                                    <td>
                                        {{ $student->regno }}
                                    </td>
                                    <td>
                                        {{ $student->name }}
                                    </td>
                                    <td>
                                        @if(\App\Attendance::where('student', $student->id)->where('lec', $lecture->id)->where('unit', $lecture->unit)->count() == 1)
                                        <button class="btn btn-xs btn-rounded btn-success" disabled="" href="">
                                            <i class="mdi mdi-check-circle"></i>
                                        </button>
                                        @else
                                            <button class="btn btn-xs btn-rounded btn-danger" disabled="" href="">
                                                <i class="mdi mdi-sign-caution"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if(\App\Attendance::where('student', $student->id)->where('lec', $lecture->id)->where('unit', $lecture->unit)->count() == 1)
                                        <a class="btn btn-xs btn-danger" href="{{ route('revokeAttendance', ['atid' => \App\Attendance::where('student', $student->id)->where('lec', $lecture->id)->where('unit', $lecture->unit)->first()->id]) }}">
                                            <i class="mdi mdi-cancel"></i> Revoke
                                        </a>
                                        @else
                                        <button class="btn btn-xs btn-danger" disabled href="#">
                                            <i class="mdi mdi-cancel"></i> Revoke
                                        </button>
                                        @endif
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
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Post Lecture Learning Material Here</h4>
                    <form method="post" action="{{ route('postAddLearningMaterial') }}" class="forms-sample" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Title: </label>
                            <div class="col-sm-9">
                                <input required minlength="5" type="text" name="title" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Select File : </label>
                            <div class="col-sm-9">
                                <input required type="file" name="material" class="form-control" id="">
                            </div>
                        </div>
                        <input type="hidden" value="{{ $lecture->id }}" name="lecture">
                        {{ csrf_field() }}
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
                            @foreach($materials as $material)
                                <tr>
                                    <td>
                                        {{ $material->id }}
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/materials/'.$material->file) }}">
                                            {{ $material->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('lecDeleteMaterial', ['file' => $material->file]) }}" class="btn btn-xs btn-danger">
                                            <i class="mdi mdi-delete"></i>Remove
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