<?php
    if(!logged_in()) {
      redirect('login');
    }

    $section  = $url[1] ?? 'dashboard';
    $action   = $url[2] ?? 'view';
    $id       = $url[3] ?? 0;
    
    $filename = "../app/pages/admin/".$section.".php";

    if(!file_exists($filename)) {
      $filename = "../app/pages/admin/404.php";
    }

    if($section == 'users') {
      require_once '../app/pages/admin/users-controller.php';
    } elseif($section == 'categories') {
      require_once '../app/pages/admin/categories-controller.php';
    } elseif($section == 'posts') {
      require_once '../app/pages/admin/posts-controller.php';
    }



?>

<!doctype html>
<html lang="en">
  
<!-- Mirrored from getbootstrap.com/docs/5.2/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Aug 2023 00:35:56 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashboard | <?=APP_NAME?></title>

    <link rel="canonical" href="index.html">

    

    

<link href="../../dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="https://getbootstrap.com/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">

<link rel="stylesheet" href="<?=ROOT ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=ROOT ?>/assets/css/dashboard.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?=ROOT?>/logout">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?=ROOT?>/admin">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/users">
              <span data-feather="file" class="align-text-bottom"></span>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/categories">
              <span data-feather="file" class="align-text-bottom"></span>
              Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=ROOT?>/admin/posts">
              <span data-feather="file" class="align-text-bottom"></span>
              Posts
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <div class="content-area">
        <?php  require_once $filename; ?>
      </div>

    </main>
  </div>
</div>

      <script src="<?=ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?=ROOT ?>/assets/js/dashboard.js"></script>
  </body>
</html>
