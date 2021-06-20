@extends('layout.layout')
@section('contents')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{setting()->site_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
            </div>
            <h4 class="page-title">{{$title}}</h4>
        </div>
    </div>
</div>

@stop
@section('css')
@stop
@section('js')
<!--Morris Chart-->
<script src="{{asset('admin/libs/morris-js/morris.min.js')}}"></script>
<script src="{{asset('admin/libs/raphael/raphael.min.js')}}"></script>

<!-- Dashboard init js-->
<script src="{{asset('admin/js/pages/dashboard.init.js')}}"></script>
@stop