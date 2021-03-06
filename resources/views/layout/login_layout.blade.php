<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
</head>
@php
    $get_settings = setting();
@endphp
<body style="background-image: url({{asset($get_settings ? $get_settings->bg_image : null)}});
    background-size: cover;background-position: left;overflow-y: hidden;">
    <div style="background-color: #2125298a;margin-top: -50px;padding-bottom: 50px;height:900px;">
        <div class="pt-5 my-5" >
            <div class="container">
                @yield('contents')
            </div>
            <!-- end container -->
        </div>
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{asset('admin/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('admin/js/app.min.js')}}"></script>
</body>
</html>