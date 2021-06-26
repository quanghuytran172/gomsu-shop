<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/auth/login");
}
include "./models/AdminModel.php";
include_once('Pagination.php');
$dataAdmin = AdminModel::getDataAdmin($_SESSION['admin_id']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <base href="http://localhost/gomsu_shop/" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Sleek - Admin Dashboard Template</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />



    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/stylesheets/sleek.css" />

    <!-- FAVICON -->
    <link href="assets/images/favicon.png" rel="shortcut icon" />
    <!-- Jquery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <!-- Trinh soan thao editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

</head>

<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">
        <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="admin">
                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                            width="30" height="33" viewBox="0 0 30 33">
                            <g fill="none" fill-rule="evenodd">
                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                            </g>
                        </svg>
                        <span class="brand-name">Admin Dashboard</span>



                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="has-sub active expand">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Dashboard</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="collapse show" id="dashboard" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="active">
                                        <a class="sidenav-item-link" href="./admin">
                                            <span class="nav-text">Ecommerce</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#ui-elements" aria-expanded="false" aria-controls="ui-elements">
                                <i class="mdi mdi-cart-outline"></i>
                                <span class="nav-text">Sản Phẩm</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="ui-elements" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="adminproduct">
                                            <span class="nav-text">Danh sách sản phẩm</span>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="adminproduct/add">
                                            <span class="nav-text">Thêm sản phẩm</span>
                                        </a>
                                    </li>


                                    <li class="has-sub">
                                        <ul class="collapse" id="widgets">
                                            <div class="sub-menu">
                                                <li>
                                                    <a href="general-widget.html">General Widget</a>
                                                </li>

                                                <li>
                                                    <a href="chart-widget.html">Chart Widget</a>
                                                </li>
                                            </div>
                                        </ul>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#charts" aria-expanded="false" aria-controls="charts">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Danh mục sản phẩm</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="charts" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="admincategory">
                                            <span class="nav-text">Danh sách danh mục</span>
                                        </a>
                                        <a class="sidenav-item-link" href="admincategory/add">
                                            <span class="nav-text">Thêm danh mục</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="adminorder">
                                <i class="mdi mdi-barcode-scan"></i>
                                <span class="nav-text">Quản lý đơn hàng</span>
                            </a>

                        </li>
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#account" aria-expanded="false" aria-controls="charts">
                                <i class="mdi mdi-account-outline"></i>
                                <span class="nav-text">Quản lý tài khoản</span>
                                <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="account" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="adminaccounts">
                                            <span class="nav-text">Danh sách tài khoản</span>
                                        </a>
                                        <a class="sidenav-item-link" href="adminaccounts/add">
                                            <span class="nav-text">Thêm tài khoản</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                </div>



                <div class="sidebar-footer">
                    <div class="sidebar-footer-content">
                        <h6 class="text-uppercase">

                        </h6>

                        <h6 class="text-uppercase">

                        </h6>

                    </div>
                </div>
            </div>
        </aside>

        <div class="page-wrapper">
            <header class="main-header" id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <div class="search-form d-none d-lg-inline-block">
                        <div class="input-group">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <input type="text" name="query" id="search-input" class="form-control" autofocus
                                autocomplete="off" />
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>

                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                            <!-- Github Link Button -->
                            <li class="github-link mr-3">

                            </li>
                            <li class="dropdown notifications-menu">
                                <button class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell-outline"></i>
                                </button>
                                <ul class="
                                            dropdown-menu dropdown-menu-right
                                        ">
                                    <li class="dropdown-header">
                                        You have 5 notifications
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-plus"></i>
                                            New user registered
                                            <span class="
                                                        font-size-12
                                                        d-inline-block
                                                        float-right
                                                    "><i class="
                                                            mdi
                                                            mdi-clock-outline
                                                        "></i>
                                                10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="
                                                        mdi mdi-account-remove
                                                    "></i>
                                            User deleted
                                            <span class="
                                                        font-size-12
                                                        d-inline-block
                                                        float-right
                                                    "><i class="
                                                            mdi
                                                            mdi-clock-outline
                                                        "></i>
                                                07 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="
                                                        mdi mdi-chart-areaspline
                                                    "></i>
                                            Sales report is ready
                                            <span class="
                                                        font-size-12
                                                        d-inline-block
                                                        float-right
                                                    "><i class="
                                                            mdi
                                                            mdi-clock-outline
                                                        "></i>
                                                12 PM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="
                                                        mdi
                                                        mdi-account-supervisor
                                                    "></i>
                                            New client
                                            <span class="
                                                        font-size-12
                                                        d-inline-block
                                                        float-right
                                                    "><i class="
                                                            mdi
                                                            mdi-clock-outline
                                                        "></i>
                                                10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="
                                                        mdi
                                                        mdi-server-network-off
                                                    "></i>
                                            Server overloaded
                                            <span class="
                                                        font-size-12
                                                        d-inline-block
                                                        float-right
                                                    "><i class="
                                                            mdi
                                                            mdi-clock-outline
                                                        "></i>
                                                05 AM</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a class="text-center" href="#">
                                            View All
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="upload/images/admin/<?php echo $dataAdmin['avatar_img'] ?>"
                                        class="user-image" alt="User Image" />
                                    <span class="d-none d-lg-inline-block"><?php echo $dataAdmin['name'] ?></span>
                                </button>
                                <ul class="
                                            dropdown-menu dropdown-menu-right
                                        ">
                                    <!-- User image -->
                                    <li class="dropdown-header">
                                        <img src="upload/images/admin/<?php echo $dataAdmin['avatar_img'] ?>"
                                            class="img-circle" alt="User Image" />
                                        <div class="d-inline-block">
                                            <?php echo $dataAdmin['name'] ?>
                                            <small class="pt-1"><?php echo $dataAdmin['email'] ?></small>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="profile.html">
                                            <i class="mdi mdi-account"></i>
                                            My Profile
                                        </a>
                                    </li>


                                    <li class="dropdown-footer">
                                        <a href="admin/logout">
                                            <i class="mdi mdi-logout"></i>
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>