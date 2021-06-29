<!DOCTYPE html>
<?php
require_once('models/CartModel.php');
require_once('models/WishListModel.php');
?>
<html>

<head>
    <title>title</title>
    <base href="http://localhost/gomsu_shop/" />
    <link rel="stylesheet" type="text/css" href="assets/stylesheets/user-style.css">
    <meta name="viewport" content="width=device-width">
    <script src="https://kit.fontawesome.com/e9a6ecd83d.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet">




</head>

<body>

    <div class="scrollup" id="scrollup">
        <i class="fa fa-angle-double-up">

        </i>
    </div>
    <div class="container-lg container-fluid container-fixed">

        <div class="col-12 ">

            <div class="header-rps">
                <div class="header-box-2">
                    <div class="image-header-2">
                        <a href=""><img class="img-fluid" src="assets/images/logo/logo.jpg"></a>
                    </div>
                    <div class="d-flex ml-auto">
                        <div class="icon-client">
                            <div class="se icon1">
                                <a href="wishlist">
                                    <i class="far fa-heart"></i>
                                </a>

                                <span class="favourite"><?php echo WishListModel::countItems(); ?></span>
                            </div>
                            <div class="se icon1 ic2">
                                <a href="checkOrder">
                                    <i class="far fa-user"></i>

                                </a>
                            </div>
                            <div class="icon2">
                                <a href="cart"><img src="assets//images/shopping-cart.svg" alt=""></a>

                                <span class="nCart"><?php echo CartModel::countItems(); ?></span>
                            </div>

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span>
                                    <i class="fas fa-bars icon2 icon2-fix"></i>

                                </span>
                            </button>

                        </div>


                    </div>


                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav list-main-2">
                        <li class="">
                            <a href="">
                                Trang chủ
                            </a>
                        </li>
                        <li>
                            <a href="shop">Sản phẩm</a>
                        </li>
                        <li>
                            <a href="site/about_us">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="contact">Liên hệ</a>
                        </li>
                        <li>
                            <a href="admin/index">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <section class="header">
            <div class="header-box">
                <div class="col-lg-3 image-header">
                    <a href=""><img class="img-fluid" src="assets/images/logo/logo.jpg"></a>
                </div>
                <div class="col-lg-9 d-flex mt-auto">
                    <div class="main-menu">
                        <ul class="list-main">
                            <li class="o1">
                                <a href="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="shop">Sản phẩm</a>
                            </li>
                            <li>
                                <a href="site/about_us">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="site/contact">Liên hệ</a>
                            </li>
                            <li>
                                <a href="admin/index">Admin</a>
                            </li>
                        </ul>
                    </div>

                    <div class="icon-client">
                        <div class="se icon1">
                            <a href="wishlist"><i class="far fa-heart"></i></a>

                            <span class="favourite"><?php echo WishListModel::countItems(); ?></span>
                        </div>
                        <div class="se icon1 ic2">
                            <a href="checkOrder"><i class="far fa-user"></i></a>

                        </div>
                        <div class="icon2">
                            <a href="cart">
                                <img src="assets/images/shopping-cart.svg" alt="">
                            </a>
                            <span class="nCart"><?php echo CartModel::countItems(); ?></span>
                            <!-- <i class="fas fa-shopping-cart"></i> -->
                        </div>

                    </div>
                </div>


            </div>
        </section>

    </div>