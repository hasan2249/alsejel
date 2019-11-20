<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Agenda')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
    window.Laravel = < ? php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ? >
    </script>

</head>

<body class="header-fixed">
    <!-- partial:partials/_header.html -->
    <nav class="t-header">
        <div class="t-header-brand-wrapper">
            <a href="<?php echo e(url('/home')); ?>">
                <img class="logo" src="/images/e209aff7-f9d5-414d-8a15-1a8a4b92072b_200x200.png" alt="">
                <img class="logo-mini" src="/images/e209aff7-f9d5-414d-8a15-1a8a4b92072b_200x200.png" alt="">
            </a>
        </div>
        <div class="t-header-content-wrapper">
            <div class="t-header-content">
                <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
                    <i class="fa fa-th-large"></i>
                </button>
                <ul class="nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="notificationDropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right"
                            aria-labelledby="notificationDropdown">
                            <div class="dropdown-header">
                                <h6 class="dropdown-title">Notifications</h6>
                                <p class="dropdown-title-text">You have 4 unread notification</p>
                            </div>
                            <div class="dropdown-body">
                                <div class="dropdown-list">
                                    <div class="icon-wrapper rounded-circle bg-inverse-primary text-primary">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Storage Full</small>
                                        <small class="content-text">Server storage almost full</small>
                                    </div>
                                </div>
                                <div class="dropdown-list">
                                    <div class="icon-wrapper rounded-circle bg-inverse-success text-success">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Upload Completed</small>
                                        <small class="content-text">3 Files uploded successfully</small>
                                    </div>
                                </div>
                                <div class="dropdown-list">
                                    <div class="icon-wrapper rounded-circle bg-inverse-warning text-warning">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Authentication Required</small>
                                        <small class="content-text">Please verify your password to continue using cloud
                                            services</small>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="messageDropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-pencil-square-o"></i>
                            <span
                                class="notification-indicator notification-indicator-primary notification-indicator-ripple"></span>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right"
                            aria-labelledby="messageDropdown">
                            <div class="dropdown-header">
                                <h6 class="dropdown-title">Messages</h6>
                                <p class="dropdown-title-text">You have 4 unread messages</p>
                            </div>
                            <div class="dropdown-body">
                                <div class="dropdown-list">
                                    <div class="image-wrapper">
                                        <img class="profile-img" src="images/profile/male/image_1.png"
                                            alt="profile image">
                                        <div class="status-indicator rounded-indicator bg-success"></div>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Clifford Gordon</small>
                                        <small class="content-text">Lorem ipsum dolor sit amet.</small>
                                    </div>
                                </div>
                                <div class="dropdown-list">
                                    <div class="image-wrapper">
                                        <img class="profile-img" src="images/profile/female/image_2.png"
                                            alt="profile image">
                                        <div class="status-indicator rounded-indicator bg-success"></div>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Rachel Doyle</small>
                                        <small class="content-text">Lorem ipsum dolor sit amet.</small>
                                    </div>
                                </div>
                                <div class="dropdown-list">
                                    <div class="image-wrapper">
                                        <img class="profile-img" src="images/profile/male/image_3.png"
                                            alt="profile image">
                                        <div class="status-indicator rounded-indicator bg-warning"></div>
                                    </div>
                                    <div class="content-wrapper">
                                        <small class="name">Lewis Guzman</small>
                                        <small class="content-text">Lorem ipsum dolor sit amet.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="appsDropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-eye-slash"></i>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="appsDropdown">
                            <div class="dropdown-header">
                                <h6 class="dropdown-title">Apps</h6>
                                <p class="dropdown-title-text mt-2">Authentication required for 3 apps</p>
                            </div>
                            <div class="dropdown-body border-top pt-0">
                                <a class="dropdown-grid">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    <span class="grid-tittle">Jira</span>
                                </a>
                                <a class="dropdown-grid">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    <span class="grid-tittle">Trello</span>
                                </a>
                                <a class="dropdown-grid">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    <span class="grid-tittle">Artstation</span>
                                </a>
                                <a class="dropdown-grid">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    <span class="grid-tittle">Bitbucket</span>
                                </a>
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- partial -->
    <div class="page-body">
        <!-- partial:partials/_sidebar.html -->
        <div class="sidebar">
            <div class="user-profile">
                <div class="display-avatar animated-avatar">
                    <img class="profile-img img-lg rounded-circle" src="/images/profile/male/image_1.png"
                        alt="profile image">
                </div>
                <div class="info-wrapper">
                    <p class="user-name"> <?php echo e(Auth::user()->name); ?> </p>
                    <h6 class="display-income"><?php echo e(Auth::user()->email); ?></h6>
                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <a class="user-name" href="<?php echo e(url('/logout')); ?>">
                            <span class="link-title">Logout</span>
                        </a>
                    </form>
                </div>
            </div>
            <ul class="navigation-menu">
                <li class="nav-category-divider">MAIN</li>
                <li>
                    <a href="<?php echo e(url('/users')); ?>">
                        <span class="link-title">Users</span>
                        <i class="glyphicon glyphicon-envelope link-icon"></i>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(url('/tasks')); ?>">
                        <span class="link-title">Tasks</span>
                        <i class="fa fa-th-large link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="link-title">Reports</span>
                        <i class="fa fa-flag link-icon "></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="link-title">Dashboard</span>
                        <i class="fa fa-cog link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="link-title">Disabled</span>
                        <i class="fa fa-refresh link-icon"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="link-title">Disabled</span>
                        <i class="fa fa-refresh link-icon"></i>
                    </a>
                </li>
                <li class="nav-category-divider">DOCS</li>
                <li>
                    <a href="../docs/docs.html">
                        <span class="link-title">Documentation</span>
                        <i class="fa fa-file-o link-icon"></i>
                    </a>
                </li>
            </ul>
            <div class="sidebar-upgrade-banner">
                <p class="text-gray">Upgrade to <b class="text-primary">PRO</b> for more exciting features</p>
                <a class="btn upgrade-btn" target="_blank"
                    href="http://www.uxcandy.co/product/label-pro-admin-template/">Upgrade to PRO</a>
            </div>
            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
        </div>
        <!-- partial -->
        <div class="page-content-wrapper">
            <div class="page-content-wrapper-inner">
                <div class="content-viewport">
                    <?php echo $__env->yieldContent('content2'); ?>
                </div>
            </div>
        </div>
        <!-- content viewport ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="row">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-5 text-center text-sm-right order-sm-1">
                    <ul class="text-gray">
                        <li><a href="#">Terms of use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-sm-5 text-center text-sm-left mt-3 mt-sm-0">
                    <small class="text-muted d-block">Copyright © 2019 <a href="http://www.uxcandy.co"
                            target="_blank">UXCANDY</a>. All rights reserved</small>
                    <small class="text-gray mt-2">Handcrafted With <i class="mdi mdi-heart text-danger"></i></small>
                </div>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- page content ends -->
    </div>
    <!-- Scripts -->
    <!-- Scripts for the template -->

    <script src="<?php echo e(asset('js/scase.js')); ?>"></script>
    <script src="<?php echo e(asset('js/core.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/template.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>

</html>