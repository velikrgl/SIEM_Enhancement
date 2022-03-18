<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> AYBU | GP </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome used before-->
  <!--<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">-->

  <script src="plugins/4f34eb3513.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="plugins//html5shiv.min.js"></script>
  <script src="plugins//respond.min.js"></script>
  <![endif]-->


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">



      <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>G-AYBU</b> PROJECT</span>
    </a>

    <!-- For mobile sidebar arrangement  -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Admin</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


      <!-- Sidebar user panel -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION MENU</li>
  <li>

    <a href="admin.php">
      <i class="fa-solid fa-house-medical"></i>
      <span>System Health</span>
    </a>
    </li>
     <li class="treeview">
    <a href="#">
      <i class="fa-solid fa-database"></i> <span>General</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="admin.php?page=generalAddDatabase"><i class="fa fa-circle-o"></i> Add Database</a></li>
      <li><a href="admin.php?page=generalListDatabase"><i class="fa fa-circle-o"></i>List Database</a></li>
      <li><a href="admin.php?page=generalDatabaseStatus"><i class="fa fa-circle-o"></i>Database Status</a></li>
    </ul>
    </li>
    <li>

    <a href="admin.php?page=accounts">
      <i class="fa-solid fa-users"></i>
      <span>Accounts</span>
    </a>

    <a href="admin.php?page=connection">
    <i class="fa-solid fa-satellite-dish"></i>
      <span>Connection</span>
    </a>

    <a href="admin.php?page=monitoring">
    <i class="fa-solid fa-desktop"></i>
      <span>Monitoring</span>
    </a>

    <a href="admin.php?page=reports">
    <i class="fa-solid fa-copy"></i>
      <span>Reports</span>
    </a>

    <a href="index.php?page=logout">
    <i class="fa-solid fa-sign-out"></i>
      <span>Sign out</span>
    </a>

  </li>

</ul>
</section>
    <!-- /.sidebar -->
  </aside>
