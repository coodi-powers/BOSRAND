
<!DOCTYPE html>
<!--[if IE 8]> <html lang="nl" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="nl" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="nl"> <!--<![endif]-->
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="nl_NL">
    <meta name="description" content="Brasserie de Bosrand de plek bij uitstek voor gezellig tafelen!">
    <meta name="keywords" content="Brasserie,Tessenderlo,vespa,vesparoute,fietscafé,Limburg,Bosrand,zavelberg">

    <meta property="og:image" content="/assets/images/logo_bosrand.png">
    <meta property="og:title" content="Brasserie de Bosrand">
    <meta property="og:description" content="De plek bij uitstek voor gezellig tafelen of om even een tussenstop te nemen tijdens het fietsen! ">

    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('/assets/images/favbosrand.png'); ?>"/>

    <meta name="author" content="COODI - Webservices">

    <title>Brasserie de Bosrand</title>

    <!-- Retina.js -->
    <!-- WARNING: Retina.js doesn't work if you view the page via file:// -->
    <script src="<?php echo base_url('assets/js/plugins/retina.min.js')?>"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/custom.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="<?php echo base_url('assets/css/animate.min.css')?>" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Economica%7COld+Standard+TT:400,400italic,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url('assets/fonts/fontawesome/css/font-awesome.min.css')?>" rel="stylesheet">

    <!-- Main CSS -->
    <link href="<?php echo base_url('assets/css/foodster.css')?>" rel="stylesheet">

    <!-- For demo purposes only -->
    <link href="<?php echo base_url('assets/css/demo.css')?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('assets/fancybox/jquery.fancybox.css')?>" type="text/css" media="screen" />

    <!-- Your custom CSS -->
    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet">
</head>

<body id="page-top" class="index">

<div id="header"></div>
<!-- Navigation -->
<nav id="nav" class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle are grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div><!-- /.navbar-header -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <?php

                $active = '';
                if($page->id == $homepage->id)
                {
                    $active = 'active';
                }
                echo '<li class="'.$active.'"><a href="/">'.$homepage->title.'</a></li>';

                foreach($menu_items_left as $menu_item)
                {
                    if($menu_item['id'] == '26')
                    {
                        echo $menukaart;
                    }
                    else
                    {
                        if(empty($menu_item['children']))
                        {
                            $active = '';

                            if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                            {
                                $active = 'active';
                            }
                            echo '<li class="'.$active.'"><a href="'.base_url('index.php/'.$menu_item['slug']).'">'.$menu_item['title'].'</a></li>';
                        }
                        else
                        {
                            $active = '';
                            if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                            {
                                $active = 'active';
                            }
                            echo '
                                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item['title'].' <span class="caret"></span></a>
                                    <ul class="dropdown-menu">';

                            foreach ($menu_item['children'] as $child)
                            {
                                echo '<li><a href="'.base_url('index.php/'.$child['slug']).'">'.$child['title'].'</a></li>';
                            }

                            echo '
                                    </ul>
                                </li>';
                        }
                    }
                }

                ?>
            </ul>
            <a class="navbar-brand page-scroll" href="/">
                <img src="/assets/images/logo_bosrand.png" alt="BrasserieBosrand">
            </a>
            <ul class="nav navbar-nav navbar-right">
                <?php
                foreach($menu_items_right as $menu_item)
                {
                    if(empty($menu_item['children']))
                    {
                        $active = '';
                        if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                        {
                            $active = 'active';
                        }
                        echo '<li class="'.$active.'"><a href="'.base_url('index.php/'.$menu_item['slug']).'">'.$menu_item['title'].'</a></li>';
                    }
                    else
                    {
                        $active = '';
                        if(($page->id == $menu_item['id']) || ($page->parent_id == $menu_item['id']))
                        {
                            $active = 'active';
                        }
                        echo '
                                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'.$menu_item['title'].' <span class="caret"></span></a>
                                    <ul class="dropdown-menu">';

                        foreach ($menu_item['children'] as $child)
                        {
                            echo '<li><a href="'.base_url('index.php/'.$child['slug']).'">'.$child['title'].'</a></li>';
                        }

                        echo '
                                    </ul>
                                </li>';
                    }

                }

                ?>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- End Navigation -->
