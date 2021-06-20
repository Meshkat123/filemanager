<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FMS-Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">
    <!-- Custom box css -->
    <link href="{{asset('admin/libs/custombox/custombox.min.css')}}" rel="stylesheet">
    <!-- App css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">
    @notifyCss
    @yield('css')

    <style>
        .swal2-popup{
            border-radius: 0px !important;
        }
        .note-editable{
            min-height: 150px !important;
        }
        .modal-demo{
            min-width: 50%;
        }
        .fixed{
            margin-top:1% !important;
            z-index: 9999999;
        }
    </style>
</head>
<body class="boxed-layout">
    <!-- Navigation Bar-->
    @include('layout.top_nav')
    <!-- End Navigation Bar-->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="wrapper">
        <div class="container-fluid">
            @yield('contents')
        </div> <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    2021 - 2021 &copy; Walton-Webportal by <a href="#">FMS</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    @notifyJs
    <!-- Vendor js -->
    <script src="{{asset('admin/js/vendor.min.js')}}"></script>

    <!-- Modal-Effect -->
        <script src="{{asset('admin/libs/custombox/custombox.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('admin/js/app.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @yield('js')
</body>
</html>