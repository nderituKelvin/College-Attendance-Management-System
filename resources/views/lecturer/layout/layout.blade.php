<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('theTitle')</title>
        <link rel="stylesheet" href="{{ asset('cmds/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
{{--        <link rel="stylesheet" href="{{ asset('cmds/vendors/iconfonts/puse-icons-feather/feather.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('cmds/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/vendors/css/vendor.bundle.addons.css') }}">
        <link rel="stylesheet" href="{{ asset('cmds/css/style.css') }}">
{{--        <link rel="stylesheet" href="{{ asset('cmds/css/bootstrap.min.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('cmds/toastr/toastr.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('cmds/images/favicon.png') }}"/>
        @yield('headAdditions')
    </head>
    <body>
        <div class="container-scroller">
        @include('lecturer.includes.topNav')
            <div class="container-fluid page-body-wrapper">
                @include('lecturer.includes.sideNav')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('theBody')
                    </div>
                    <footer class="footer">
                        <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{ date('Y') }}
                            <a href="https://www.github.com/nderituKelvin" target="_blank">Meru University</a>. All rights reserved.</span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <script src="{{ asset('cmds/toastr/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('cmds/toastr/toastr.min.js') }}"></script>
{{--        <script src="{{ asset('cmds/css/bootstrap.min.js') }}"></script>--}}
        <script src="{{ asset('cmds/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('cmds/vendors/js/vendor.bundle.addons.js') }}"></script>
        <script src="{{ asset('cmds/js/off-canvas.js') }}"></script>
        <script src="{{ asset('cmds/js/misc.js') }}"></script>
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <script type="text/javascript">
                toastr.{{ \Illuminate\Support\Facades\Session::get('status') }}('{{ \Illuminate\Support\Facades\Session::get('message') }}', '{{ \Illuminate\Support\Facades\Session::get('title') }}');
            </script>
        @endif
        @yield('theScripts')
    </body>
</html>