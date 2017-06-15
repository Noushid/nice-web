<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo public_url() . 'img/ico.png';?>" type="image/png" sizes="47x54">
    <title>Dashboard- Classic International</title>
    <link rel="stylesheet" href="<?php echo public_url() . 'assets/admin/css/styleapp.css'; ?>">
    <link rel="stylesheet" href="<?php echo public_url() . 'assets/admin/css/custom.css'; ?>">
    <script type="text/javascript" src="<?php echo public_url() . 'assets/admin/js/appjs.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo public_url() . 'assets/admin/js/custom.js'; ?>"></script>

    <script src="<?php echo public_url() . 'assets/admin/js/angular-bootstrap.min.js' ?>"></script>
    <!--    <script src="--><?php //echo public_url() . 'assets/admin/js/angularApp.min.js' ?><!--"></script>-->
    <script src="<?php echo public_url() . 'assets/admin/js/angularApp.js' ?>"></script>

    <style>
        .disabled {
            z-index: 1000;
            background-color: lightgrey;
            pointer-events: none;
        }
    </style>

</head>
<body ng-app="myApp" ng-controller="adminController">
<div class="page-wrapper" ng-class="{disabled: loading}">
    <div class="left-wrapper" >
        <?php echo dashboard_menu();?>
    </div>
    <nav class="top-wrapper">
        <div class="sidebar-top">
            <button class="humburger pull-left">
                <i class="fa fa-bars fa-2x center-block"></i>
            </button>
            <ul class="menu-top pull-right">
                <li>
                    <a href="#"><i class="fa fa-envelope-o fa-lg"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bell-o fa-lg"></i></a>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" id="settings" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog fa-lg"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="settings">
                        <li><a href="<?php echo base_url('admin/#edit-profile') ?>">Edit Profile</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('logout');?>">logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div ng-view></div>
</div>
</body>
</html>

