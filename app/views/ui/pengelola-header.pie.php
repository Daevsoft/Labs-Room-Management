<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SRM | _(( app_name() ))</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @css('font-awesome/fontawesome.min')
  @css('font-awesome/solid.min')
  @css('overlayScrollbars/css/OverlayScrollbars.min')
  @css('adminlte.min')
  @css('dataTables/dataTables.bootstrap4.min')
  @css('select2/select2.min')
  @css('select2-bootstrap4-theme/select2-bootstrap4.min')
  @css('sweetalert2/bootstrap-4.min') 

  @css('style')

  <!-- jQuery -->
  @js('jquery/jquery.min')
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>
<body class="sidebar-mini layout-fixed sidebar-collapse text-sm" style="height: auto;">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand text-sm navbar-dark navbar-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="_(( site('main/logout') ))">
          <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-primary navbar-navy">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-sm navbar-primary">
      <span class="brand-text font-weight-light text-white">_(( app_name() ))</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host"><div class="os-resize-observer observed" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer observed"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 256px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <h4 class="img-circle elevation-2 bg-white" style="text-align:center;width:30px;height:30px;">_(( ucfirst(getUser('NamaA')[0]) ))</h4>
        </div>
        <div class="info">
          <a href="_(( site('admin') ))" class="d-block">_(( getUser('NamaA') ))</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="_(( site('main/laboratorium') ))" class="nav-link _(( nav_active($title, 'laboratorium') ))">
              <i class="nav-icon fas fa-flask"></i>
              <p>
                Laboratorium
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="_(( site('main/profil_saya') ))" class="nav-link _(( nav_active($title, 'profil saya') ))">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Profil Saya
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="_(( site('main/jadwal_pemakaian') ))" class="nav-link  _(( nav_active($title, 'jadwal pemakaian') ))">
              <i class="fas fa-calendar-alt nav-icon"></i>
              <p>Jadwal Pemakaian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="_(( site('main/inventaris') ))" class="nav-link  _(( nav_active($title, 'data inventaris') ))">
              <i class="fas fa-box nav-icon"></i>
              <p>Data Inventaris</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 23.9963%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 471.047px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADMINISTRATOR</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header bg-dark">
                <div class="card-title">
                  <h5>_(( $title ))</h5>
                </div>
              </div>
              <div class="card-body">
                _(( flash('error') ))