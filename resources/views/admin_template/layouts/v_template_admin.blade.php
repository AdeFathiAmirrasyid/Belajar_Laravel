<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>AdminLTE 3 | Dashboard</title>
    <meta charset="utf-8">
    <meta name="keywords" content="divisima, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
  <body>
    @section('navbar')
    <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url("/dashboard")}}" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
            <!-- Navbar Search -->
            <div class="input-group input-group-sm mt-1">
              <input  class="form-control form-control-navbar" name="search" type="search" id="search"
                placeholder="Search" aria-label="Search" autocomplete="off" >
            </div>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="user-panel ">
                    <div class="image">
                      <img src="{{asset("AdminLTE-tamplate/dist/img/profil.jpg")}}" class="img-circle " alt="User Image">
                      <span class="mx-1"> {{ Auth::user()->nama }} </span>
                    </div>
                  </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-item p-3  bg-primary text-white">
                        <div class="d-flex justify-content-center mb-2">
                            <img src="{{asset("AdminLTE-tamplate/dist/img/profil.jpg")}}" alt="User Image" class="img-size-50 mr-3 img-circle">
                        </div>
                        <p class="text-center">{{ Auth::user()->nama }}</p>
                        <p class="text-center">Web Developer -
                            <small class="text-center">{{ Auth::user()->level }}</small>
                        </p>
                    </div>
            </ul>
          </li>
        </ul>
      </nav>
    <!-- End Navbar -->
    @endsection


    @section('sidebar')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{asset("AdminLTE-tamplate/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset("AdminLTE-tamplate/dist/img/profil.jpg")}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{url("/dashboard/product")}}" class="nav-link">
                <img src="{{asset("AdminLTE-tamplate/dist/img/product.png")}}" alt="" width="18px" >
                <p class="mx-2">Product</p>
            </a>

            </li>
            <li class="nav-item">
              <a href="{{url("/dashboard/user")}}" class="nav-link">
                <i class="fas fa-users"></i>
                <p class="mx-2">User</p>
            </a>
            </li>
            <li class="nav-item">
                <a href="{{url("/dashboard/order")}}" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <p class="mx-2">Orders</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="
                event.preventDefault();
                document.getElementById('logout').submit();">
                   <i class="fas fa-sign-out-alt"></i>
                   <p class="mx-2">Log Out</p>
                </a>
            </li>
            <form id="logout" action="{{ route('logout') }}" method="POST">@csrf</form>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- End Main Sidebar Container -->
    @endsection

    @section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('judul')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    @endsection

    @include('admin_template/layouts/v_script')
    @yield('navbar')
    @yield('sidebar')
    @yield('content')
    @yield('notifikasi')
    @yield('content-product')
    @yield('content-insert')
    @yield('content-user')
    @yield('content-order')

  </body>
</html>
