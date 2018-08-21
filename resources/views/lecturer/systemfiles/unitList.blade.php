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
                            <form method="post" action="{{ route('postAddUnit') }}" class="forms-sample">
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
                                {{ csrf_field() }}
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
                            @foreach($units as $unit)
                                <tr>
                                    <td>
                                        <a href="{{ route('lecturerUnitDetail', ['unitid' => $unit->id]) }}">{{ $unit->code }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('lecturerUnitDetail', ['unitid' => $unit->id]) }}">{{ $unit->name }}</a>
                                    </td>
                                    <td>
                                        @if($unit->status == "active")
                                       <button class="btn btn-xs btn-success disabled">Active</button>
                                        @else
                                        <button class="btn btn-xs btn-info disabled">Completed</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if(\App\Lecture::where('unit', $unit->id)->count() != 0)
                                        {{ substr((\App\Attendance::where('unit', $unit->id)->count() / (\App\Reg::where('unit', $unit->id)->count() * \App\Lecture::where('unit', $unit->id)->count() )   ) * 100, 0, 4) }}
                                        @else
                                            {{ 0 }}
                                        @endif
                                         %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{ $units->links() }}
                </div>
            </div>
        </div>
    </div>



@endsection
@section('theScripts')

@endsection