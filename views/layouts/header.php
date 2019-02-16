<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>LuxLife</title>
        <link href="/online_shop/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/online_shop/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/online_shop/template/css/prettyPhoto.css" rel="stylesheet">
        <link href="/online_shop/template/css/price-range.css" rel="stylesheet">
        <link href="/online_shop/template/css/animate.css" rel="stylesheet">
        <link href="/online_shop/template/css/main.css" rel="stylesheet">
        <link href="/online_shop/template/css/responsive.css" rel="stylesheet">
        <link href="/online_shop/template/css/footerdown.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
<!--        <link rel="shortcut icon" href="/online_shop/template/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/online_shop/template/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/online_shop/template/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/online_shop/template/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/online_shop/template/images/ico/apple-touch-icon-57-precomposed.png">-->
    </head><!--/head-->
    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +38 097 109 20 96</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> kgmerlin777gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->
            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="/online_shop/"><img src="/online_shop/template/images/home/name2.jpg" height="85" width="150" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">                                    
                                    <li><a href="/online_shop/cart/"> 
                                            <i class="fa fa-shopping-cart"></i> Корзина
                                            <span id="cart-count">(<?php echo Cart::countItems(); ?>)</span>
                                        </a>
                                    </li>
                                    <?php if (User::isGuest()): ?>
                                        <li><a href="/online_shop/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                    <?php else: ?>
                                        <li><a href="/online_shop/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                        <li><a href="/online_shop/user/logout/"><i class="fa fa-unlock"></i>Выход</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->
            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/online_shop/">Главная</a></li>
                                    <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="/online_shop/catalog/page-1">Каталог товаров</a></li>
                                            <li><a href="/online_shop/cart/">Корзина</a></li> 
                                        </ul>
                                    </li> 
                                    <li><a href="/online_shop/about/">О магазине</a></li>
                                    <li><a href="/online_shop/contact/">Контакты</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->

        </header><!--/header-->
