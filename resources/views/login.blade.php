<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>C.M.D.S - Login</title>
        <link rel="stylesheet" href="{{ asset('cmds/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/vendors/iconfonts/puse-icons-feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/vendors/css/vendor.bundle.addons.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/toastr/toastr.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('cmds/images/favicon.png') }}"/>
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                    <div class="row w-100">
                        <div class="col-lg-4 mx-auto">
                            <div class="auto-form-wrapper">
                                <h1 class="text-center mb-4">Login</h1>
                                <form action="#">
                                    <div class="form-group">
                                        <label class="label">Registration Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Registration Number">
                                            <div class="input-group-append">
                                              <span class="input-group-text">

                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="*********">
                                            <div class="input-group-append">
                                              <span class="input-group-text">

                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary submit-btn btn-block">Login</button>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <div class="form-check form-check-flat mt-0">

                                        </div>
                                        <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                                    </div>
                                    <div class="text-block text-center my-3">
                                        <span class="text-small font-weight-semibold">
                                            <a href="{{ route('signUpPage') }}">Sign Up Here</a>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <p class="footer-text text-center">Copyright © {{ date("Y") }} .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('cmds/toastr/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('cmds/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('cmds/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('cmds/vendors/js/vendor.bundle.addons.js') }}"></script>
        <script src="{{ asset('cmds/js/off-canvas.js') }}"></script>
        <script src="{{ asset('cmds/js/misc.js') }}"></script>
    </body>

</html>