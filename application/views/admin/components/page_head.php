<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>COODI | <?php echo $title; ?></title>

    <link href="<?php echo base_url('assets_admin/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets_admin/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url('assets_admin/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url('assets_admin/js/plugins/gritter/jquery.gritter.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets_admin/css/plugins/select2/select2.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets_admin/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">



    <link href="<?php echo base_url('assets_admin/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets_admin/css/style.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets_admin/css/custom.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets_admin/ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('assets_admin/ckfinder/ckfinder.js'); ?>"></script>

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <i class="fa fa-user fa-3x"></i>
                            <!-- <img alt="image" class="img-circle" src="img/profile_small.jpg" /> -->
                             </span>
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold"><?php echo $this->session->username ?></strong>
                                    </span>
                                </span>
                    </div>
                    <div class="logo-element">
                        KI+
                    </div>
                </li>


                <?php
                $class = "";
                if($this->uri->segment(2) == 'dashboard')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo anchor('admin/dashboard', '');
                echo '"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(2) == 'user')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo anchor('admin/user', '');
                echo '"><i class="fa fa-users"></i> <span class="nav-label">Gebruikers</span></a>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(2) == 'page')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo anchor('admin/page', '');
                echo '"><i class="fa fa-desktop"></i> <span class="nav-label">Pagina\'s</span></a>';
                echo '</li>';
                $class = "";
                if($this->uri->segment(2) == 'menu')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo '#';
                echo '"><i class="fa fa-cutlery" aria-hidden="true"></i> <span class="nav-label">Menukaart</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">';

                $class = "";
                if($this->uri->segment(3) == 'menucat')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                <a href="';
                echo anchor('admin/menu/menucat', '');
                echo '">Menu</span></a>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(3) == 'drank')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                    <a href="';
                echo anchor('admin/menu/drank', '');
                echo '">Dranken</span></a>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(3) == 'gerecht')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                        <a href="';
                echo anchor('admin/menu/gerecht', '');
                echo '">Gerechten</span></a>';
                echo '</li>';

                echo '</ul>';

                $class = "";
                if($this->uri->segment(2) == 'plugins')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo '#';
                echo '"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> <span class="nav-label">Plugins</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">';

                $class = "";
                if($this->uri->segment(3) == 'tekst')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                    <a href="';
                echo anchor('admin/plugins/tekst', '');
                echo '">Tekst</span></a>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(3) == 'service')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                            <a href="';
                echo anchor('admin/plugins/service', '');
                echo '">Services</span></a>';
                echo '</li>';


                if($this->uri->segment(3) == 'banners')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                                                <a href="';
                echo anchor('admin/plugins/banners', '');
                echo '">Banners</span></a>';
                echo '</li>';

                echo '</ul>';
                echo '</li>';

                $class = "";
                if($this->uri->segment(2) == 'video')
                {
                    $class = "active";
                }
                echo '<li class="'.$class.'">
                <a href="';
                echo anchor('admin/video', '');
                echo '"><i class="fa fa-youtube-play" aria-hidden="true"></i> <span class="nav-label">Video\'s</span></a>';
                echo '</li>';


                echo '<li class="">
                <a href="#" onclick="BrowseServer(\'Images:/\',\'foto\');"><i class="fa fa-folder-open-o"></i> <span class="nav-label">Bestanden</span></a>';
                echo '</li>';


                echo '</li>';

                ?>

            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welkom bij COODI.</span>
                    </li>
                    <li>
                        <a href="<?php echo anchor('admin/user/logout', ''); ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-sm-12">
                <h2><?php echo $page_title; ?></h2>
            </div>
        </div>