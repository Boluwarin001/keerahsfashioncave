<?php 
    require_once "../inc/conn.php";
    $cart_count =get_cart_count();

    if (logged_in()==true) {
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_info WHERE email='".$_SESSION['email']."'"));
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KEERAH'S</title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">




    <link rel="stylesheet" href="../assets/css/vendor.min.css">
    <link rel="stylesheet" href="../assets/css/plugins.min.css">
    <link rel="stylesheet" href="../assets/css/style.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

  <!-- font -->
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@300&display=swap" rel="stylesheet">

</head>

<body>

    <div class="header" style="z-index: 5;position: relative;">


        <!-- Header Top Start -->
        <div class="header-top bg-light">
            <div class="container">
                <div class="row row-cols-xl-2 align-items-center">

                    <!-- Header Top Language, Currency & Link Start -->
                    <div class="col d-none d-lg-block">
                        <div class="header-top-lan-curr-link">
                            <div class="header-top-lan dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <li><a class="dropdown-item" href="#">Japanese</a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item" href="#">Romanian</a></li>
                                </ul>
                            </div>
                            <div class="header-top-curr dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">Pound</a></li>
                                    <li><a class="dropdown-item" href="#">Euro</a></li>
                                    <li><a class="dropdown-item" href="#">Naira</a></li>
                                </ul>
                            </div>
                            <div class="header-top-links">
                                <span>Call Us</span><a href="tel:+2348112583078"> +234 81 1258 3078</a>
                            </div>
                        </div>
                    </div>
                    <!-- Header Top Language, Currency & Link End -->

                    <!-- Header Top Message Start -->
                    <div class="col">
                        <p class="header-top-message">Registration for Keerah's Fashion Academy ends Monday, 5 June 2023<a href="#">Register Now</a></p>
                    </div>
                    <!-- Header Top Message End -->

                </div>
            </div>
        </div>
        <!-- Header Top End -->


        <!-- Header Bottom Start -->
        <div class="header-bottom">
            <div class="header-sticky">
                <div class="container">
                    <div class="row align-items-center">

                        <!-- Header Logo Start -->
                        <div class="col-xl-2 col-6">
                            <div class="header-logo">
                                <a href="index.php"><img src="../assets/images/logo/logo2.png" height="50px" alt="Site Logo" /></a>
                            </div>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="col-xl-8 d-none d-xl-block">
                            <div class="main-menu position-relative">
                                <ul>
                                    <li><a href="../"> <span>Home</span></a></li>
                                    <li><a href="shop.php"> <span>Shop</span></a></li>
                                    <li><a href="#"> <span>Stories</span></a></li>

                                    <!-- <li><a href="about.php"> <span>About</span></a></li> -->
                                    <!-- <li><a href="blog.php"> <span>Blog</span></a></li> -->
                                    <li><a href="contact.php"> <span>Contact</span></a></li>
                                    <li><a href="https://www.instagram.com/keerahsfashioncave/" target="_blank"> <span>Instagram</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Action Start -->
                        <div class="col-xl-2 col-6">
                            <div class="header-actions">

                                <!-- Search Header Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-search"><i class="pe-7s-search"></i></a>
                                <!-- Search Header Action Button End -->

                                <!-- User Account Header Action Button Start -->
                                <a href="my-account.php" class="header-action-btn d-none d-md-block"><i class="pe-7s-user"></i></a>
                                <!-- User Account Header Action Button End -->

                                <!-- Wishlist Header Action Button Start -->
                                <a href="wishlist.html" class="header-action-btn header-action-btn-wishlist d-none d-md-block">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <!-- Wishlist Header Action Button End -->

                                <!-- Shopping Cart Header Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-cart">
                                    <i class="pe-7s-shopbag"></i>
                                    <span class="header-action-num"><?php echo $cart_count; ?></span>
                                </a>
                                <!-- Shopping Cart Header Action Button End -->

                                <!-- Mobile Menu Hambarger Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-menu d-xl-none d-lg-block">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <!-- Mobile Menu Hambarger Action Button End -->

                            </div>
                        </div>
                        <!-- Header Action End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom End -->

        <!-- Mobile Menu Start -->
        <div class="mobile-menu-wrapper">
            <div class="offcanvas-overlay"></div>

            <!-- Mobile Menu Inner Start -->
            <div class="mobile-menu-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Mobile Menu Start -->
                <div class="mobile-navigation">
                    <nav>
                        <ul class="mobile-menu">
                            <li><a href="../my-account.php">My Account</a></li>
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../shop.php">Shop</a></li>
                            <!-- <li><a href="blog.php">Blog</a></li> -->
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="https://www.instagram.com/keerahsfashioncave/">Instagram</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Mobile Menu End -->

                <!-- Language, Currency & Link Start -->
                <div class="offcanvas-lag-curr mb-6">
                    <h2 class="title">Languages</h2>
                    <div class="header-top-lan-curr-link">
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                <li><a class="dropdown-item" href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">NGN<i class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                <!-- <li><a class="dropdown-item" href="#">USD</a></li> -->
                                <!-- <li><a class="dropdown-item" href="#">Pound</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Language, Currency & Link End -->

                <!-- Contact Links/Social Links Start -->
                <div class="mt-auto">

                    <!-- Contact Links Start -->
                    <ul class="contact-links">
                        <li><i class="fa fa-phone"></i><a href="#"> 
                        +234 81 1258 3078</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="#"> keerahsfashioncave@gmail.com</a></li>
                        <li><i class="fa fa-clock-o"></i> <span>Monday - Sunday 9.00 - 18.00</span> </li>
                    </ul>
                    <!-- Contact Links End -->

                    <!-- Social Widget Start -->
                    <div class="widget-social">
                        <a title="Whatsapp" href="https://api.whatsapp.com/send?phone=2348112583078&text=Hey!%20I%20would%20like%20to%20get%20more%20Info"><i class="fa fa-whatsapp"></i></a>
                        <a title="Instagram" href="https://www.instagram.com/keerahsfashioncave/"><i class="fa fa-instagram"></i></a>
                        <a title="Phone" href="tel:+2348112583078"><i class="fa fa-phone"></i></a>
                    </div>
                    <!-- Social Widget Ende -->
                </div>
                <!-- Contact Links/Social Links End -->
            </div>
            <!-- Mobile Menu Inner End -->
        </div>
        <!-- Mobile Menu End -->

        <!-- Offcanvas Search Start -->
        <div class="offcanvas-search">
            <div class="offcanvas-search-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Search Form Start -->
                <form class="offcanvas-search-form" action="#">
                    <input type="text" placeholder="Search Product..." class="offcanvas-search-input">
                </form>
                <!-- Offcanvas Search Form End -->

            </div>
        </div>
        <!-- Offcanvas Search End -->

        <!-- Cart Offcanvas Start -->
        <div class="cart-offcanvas-wrapper">
            <div class="offcanvas-overlay"></div>

            <!-- Cart Offcanvas Inner Start -->
            <div class="cart-offcanvas-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Cart Content Start -->
                <div class="offcanvas-cart-content">


                </div>
                <!-- Offcanvas Cart Content End -->

            </div>
            <!-- Cart Offcanvas Inner End -->
        </div>
        <!-- Cart Offcanvas End -->

    </div>

    <?php // exit(); ?>