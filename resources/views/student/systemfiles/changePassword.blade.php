@extends('student.layout.layout')
@section('theTitle')
    Student - Change Password
@endsection
@section('theBody')
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Password</h4>
                            <form method="post" action="{{ route('lecChangePassword') }}" class="forms-sample">
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">New Password: </label>
                                    <div class="col-sm-9">
                                        <input required minlength="7" type="password" name="newpass" class="form-control" id="" placeholder="Enter Your New Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Confirm Password: </label>
                                    <div class="col-sm-9">
                                        <input type="password" required name="conpass" class="form-control" id="" placeholder="Confirm Your New Password">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success mr-2"> <i class="mdi mdi-textbox-password"></i> Update Password</button>
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