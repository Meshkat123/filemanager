<style>
    .quick_menue:hover{
        box-shadow: 0px 2px 5px 0px rgb(220 215 215 / 75%);
        transition: .5s;
        padding-bottom: 10px;
    }
    .submenu li{
        border-bottom: 1px dotted lightgray;
    }
    .navigation-menu>li.last-elements .submenu>li.has-submenu .submenu{
        left: 100%;
        right: auto;
    }
</style>
<header id="topnav">
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell-outline noti-icon"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <div class="dropdown-item noti-title">
                            <h5 class="font-16 text-white m-0">
                                <span class="float-right">
                                    <a href="#" class="text-white">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>
                        <div class="slimscroll noti-scroll">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-success">
                                    <i class="mdi mdi-settings-outline"></i>
                                </div>
                                <p class="notify-details">New settings
                                    <small class="text-muted">There are new settings available</small>
                                </p>
                            </a>
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset(Auth::user() ? Auth::user()->image : null)}}" alt="user" class="rounded-circle" style="display: initial;">
                        <span class="d-none d-sm-inline-block ml-1 font-weight-medium">{{Auth::user() ? Auth::user()->name : null}}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow text-white m-0">Welcome ! {{Auth::user() ? Auth::user()->name : null}}</h6>
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile</span>
                        </a>
                        <a class="dropdown-item notify-item" href="{{route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout-variant"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{route('admin:index')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('admin/images/logo.png')}}" alt="" style="height: 22px;display: initial;">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('admin/images/logo-sm.png')}}" alt="" style="height: 22px;display: initial;">
                    </span>
                </a>
                <a href="{{route('admin:index')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('admin/images/logo-light.png')}}" alt="" style="height: 22px;display: initial;">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('admin/images/logo-sm-light.png')}}" alt="" style="height: 22px;display: initial;">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="#"> <i class="mdi mdi-view-dashboard"></i>Site<div class="arrow-down"></div></a>
                        <ul class="submenu">
                            <li><a href="{{route('admin:index')}}">Dashboard</a></li>
                            <li><a href="{{route('admin:setup_site')}}">Settings</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"> <i class="mdi mdi-black-mesa"></i>Users<div class="arrow-down"></div></a>
                        <ul class="submenu">
                            <li><a href="{{route('admin:user')}}">User List</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"> <i class="mdi mdi-black-mesa"></i>File Management<div class="arrow-down"></div></a>
                        <ul class="submenu">
                            <li><a href="{{route('admin:files')}}">File List</a></li>
                            <li><a href="{{route('admin:files.setup')}}">File Setup</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</header>
@include('notify::messages')