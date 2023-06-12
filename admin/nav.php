<?php 

	require_once("../inc/conn.php");

 ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Keerah Dashboard</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link href="admin.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">KEERAH ADMIN</a>

  <button class="navbar-toggler position-absolute d-md-none collapsed" onclick="toggleSidebar();">
    <span class="navbar-toggler-icon"></span>
  </button>


  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">

        <ul class="nav flex-column">

          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all-listings.php">
              <span data-feather="percent"></span>
              All listings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="edit-listing.php">
              <span data-feather="bar-chart-2"></span>
              Add Listing
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orders">
              <span data-feather="bar-chart-2"></span>
              Orders
            </a>
          </li>

        </ul>


        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>USERS</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="git-commit"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">

          <li class="nav-item">
            <a class="nav-link" href="user-info">
              <span data-feather="user-plus"></span>
              User Info
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="user-login">
              <span data-feather="user-plus"></span>
              User Login
            </a>
          </li>


<!--         <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>External</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="git-commit"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="../blog/admin">
              <span data-feather="bar-chart-2"></span>
              Blog
            </a>
          </li>
          <li class="nav-item">
            <a target="_blank" class="nav-link" href="#">
              <span data-feather="corner-up-right"></span>
              Google Analytics
            </a>
          </li>

          <li class="nav-item">
            <a target="_blank" class="nav-link" href="https://dashboard.tawk.to/#/dashboard">
              <span data-feather="corner-up-right"></span>
              Tawk.to
            </a>
          </li>
        </ul>
 -->
      </div>
    </nav>


<script type="text/javascript">
  function toggleSidebar(){

    $("#sidebarMenu").toggle();
  }
</script>