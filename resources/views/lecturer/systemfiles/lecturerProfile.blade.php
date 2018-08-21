@extends('lecturer.layout.layout')
@section('theTitle')
    Lecturer - Profile
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profile</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/images/'.\App\Photo::where('native', 'user')->where('nativeid', \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())->first()->name) }}" class="img-lg rounded-circle" alt="">
                                </div>
                                <div class="col-md-3">
                                    Reg No: {{ \Illuminate\Support\Facades\Auth::user()->regno }}
                                </div>
                                <div class="col-md-3">
                                    Name: {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                </div>
                                <div class="col-md-3">
                                    ID: {{ \Illuminate\Support\Facades\Auth::user()->idno }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Profile</h4>
                            <form method="post" action="{{ route('postLecUpdateProfile') }}" class="forms-sample" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="3" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" type="text" name="name" class="form-control" id="" placeholder="Enter Your Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">ID Number: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="7" value="{{ \Illuminate\Support\Facades\Auth::user()->idno }}" type="number" name="idno" class="form-control" id="" placeholder="Enter Your National ID Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Profile Image: </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="proffpic" class="form-control" id="" placeholder="Unit Name">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-account-edit"></i> Update</button>
                                <button class="btn btn-light reset">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('theScripts')

@endsection