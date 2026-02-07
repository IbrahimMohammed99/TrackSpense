<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{--                    <img src="../../dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">--}}

                    <img src="{{ auth()->user()->photo
                ? asset('storage/' . auth()->user()->photo)
                : asset('images/default-user.png') }}"
                         alt="Profile Photo"
                         class="user-image img-circle elevation-2">

                    <span class="d-none d-md-inline">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ auth()->user()->photo
                ? asset('storage/' . auth()->user()->photo)
                : asset('images/default-user.png') }}"
                             alt="Profile Photo"
                             class="user-image img-circle elevation-2">

                        <p>
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                            <small>Member
                                since {{\Illuminate\Support\Carbon::parse(Auth::user()->created_at)->format('F - Y')}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout').submit();">Logout</a>
                        <form action="{{ route('logout') }}" method="post" style="display: none;" id="logout">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src="{{asset('dist/img/logotrackspense.jpeg')}}" alt="TrackSpense Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span style="color: #ffffff;">Track</span><b style="color: #28a745;">Spense</b>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->photo
                ? asset('storage/' . auth()->user()->photo)
                : asset('images/default-user.png') }}"
                         alt="Profile Photo"
                         class="user-image img-circle elevation-2">
                </div>
                <div class="info">
                    <a href="{{ route('profile.edit') }}" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item {{ request()->routeIs('expenses.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-exchange-alt"></i> <!-- Transactions -->
                            <p>
                                Transactions
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('expenses.create')}}" class="nav-link  {{ request()->routeIs('expenses.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Expenses</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('expenses.index')}}" class="nav-link  {{ request()->routeIs('expenses.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expenses Summary</p>
                                </a>
                            </li>

                        </ul>

                    </li>
                    <li class="nav-item  {{ request()->routeIs('categories.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list-alt"></i> <!-- Categories Management -->
                            <p>
                                Categories Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link  {{ request()->routeIs('categories.index') ? 'active' : '' }}"  >
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  {{ request()->routeIs('incomes.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('incomes.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill-wave"></i> <!-- Categories Management -->
                            <p>
                                Incomes Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('incomes.show')}}" class="nav-link  {{ request()->routeIs('incomes.show') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Show</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('incomes.index')}}" class="nav-link  {{ request()->routeIs('incomes.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Incomes</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  {{ request()->routeIs('statistics*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('statistics*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i> <!-- Reports & Charts -->
                            <p>
                                Reports & Charts
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('statistics.dailyAverage')}}" class="nav-link   {{ request()->routeIs('statistics.dailyAverage') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Average Daily</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('statistics.categoryTotals')}}" class="nav-link   {{ request()->routeIs('statistics.categoryTotals') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Total by Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('statistics.daily') }}" class="nav-link   {{ request()->routeIs('statistics.daily') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Daily Expenses Chart</p>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class="nav-item  {{ request()->routeIs('profile.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i> <!-- User Settings -->
                            <p>
                                User Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('profile.edit')}}" class="nav-link  {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_heading')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">@yield('page_heading')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- /.row -->
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('main_content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Smart Expense Tracking
    </div>

    <strong>Copyright &copy; 2025-{{ date('Y') }} <a href="{{ url('/') }}">TrackSpense</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@yield('JS_content')
</body>
</html>
