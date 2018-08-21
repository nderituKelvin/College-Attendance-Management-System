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
                                    Average Attendance
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regs as $reg)
                                <?php $unit = \App\Unit::where('id', $reg->unit)->first() ?>
                                <tr>
                                    <td>
                                        <a href="{{ route('studentUnitDetail', ['unitid' => $unit->id] ) }}">{{ $unit->code }}</a>

                                    </td>
                                    <td>
                                        <a href="{{ route('studentUnitDetail', ['unitid' => $unit->id]) }}">{{ $unit->name }}</a>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/images/'.\App\Photo::where('native', 'user')->where('nativeid', $unit->lec)->first()->name) }}" class="img-md rounded-circle" alt="">
                                        {{ \App\User::where('id', $unit->lec)->first()->name }}
                                    </td>
                                    <td>
                                        {{ substr((\App\Attendance::where('student', \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())->where('unit', $unit->id)->count() / \App\Lecture::where('unit', $unit->id)->count()) * 100, 0, 4) }}
                                        %
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $regs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('theScripts')

@endsection