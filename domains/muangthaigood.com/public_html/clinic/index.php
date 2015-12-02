<?php include_once($_SERVER["DOCUMENT_ROOT"] . '/lib/application.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>เรียล เมดิค คลีนิค Real Medic Clinic</title>
        <META name=keywords 
              content="เรียล เมดิค คลีนิค Real Medic Clinic">
            <META name=description content="เรียล เมดิค คลีนิค Real Medic Clinic">
                <link rel="icon" href="<?= ADDRESS ?>images/icon.png" type="image/x-icon" />
                <link rel="stylesheet" type="text/css" href="<?= ADDRESS ?>style.css" />
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                <script src="<?= ADDRESS ?>dist/slippry.min.js"></script>
                <script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
                <meta name="viewport" content="width=device-width">
                    <link rel="stylesheet" href="<?= ADDRESS ?>slide.css">
                        <link rel="stylesheet" href="<?= ADDRESS ?>dist/slippry.css">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
                                <!-- Latest compiled and minified JavaScript -->
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
                                <link rel="stylesheet" href="<?= ADDRESS ?>responsivestyle.css"/>
                                </head>

                                <body>
                                    <nav class="navbar navbar-default">
                                        <div class="container-fluid">
                                            <!-- Brand and toggle get grouped for better mobile display -->
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                                <a class="navbar-brand" href="#"><img src="<?= ADDRESS ?>images/logofooter_head.jpg"></a>
                                            </div>

                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                <ul class="nav navbar-nav">
                                                    <li class="<?= PAGE_CONTROLLERS == 'index' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>">HOME <span class="sr-only">(current)</span></a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'about' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>about.html">ABOUT US</a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'promotion' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>promotion.html">PROMOTION</a></li>
                                                    <li  class="dropdown <?= PAGE_CONTROLLERS == 'services' ? 'active open' : '' ?>"> 
                                                        <a href="<?= ADDRESS ?>services.html" class="dropdown-toggle open"  role="button" aria-haspopup="true" aria-expanded="true">SERVICES <span class="caret"></span></a>
                                                        <ul class="dropdown-menu"> 
                                                            <?php
                                                            $sql = "SELECT * FROM " . $services->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
                                                            $query = $db->Query($sql);
                                                            $arrID = explode('-', $_GET['id']);
                                                            while ($row = $db->FetchArray($query)) {
                                                                ?>
                                                                <li class="<?= $row['id'] == $arrID[0] ? 'active' : '' ?>"><a href="<?= ADDRESS . 'services/' . $row['id'] . '-' . $row['services_title'] ?>.html"><?= $row['services_title'] ?></a></li>

                                                            <?php } ?>

                                                        </ul>
                                                    </li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'contact' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>contact.html">CONTACT US</a></li>
                                                </ul>
                                            </div><!-- /.navbar-collapse -->
                                        </div><!-- /.container-fluid -->
                                    </nav>


                                    <div class="container-fluid" id="page-content" style="padding: 0px;"> 

                                        <div id="header">
                                            <div id="menu">
                                                <ul>
                                                    <li class="<?= PAGE_CONTROLLERS == 'index' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>">HOME</a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'about' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>about.html">ABOUT US</a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'services' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>services.html">SERVICES</a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'promotion' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>promotion.html">PROMOTION</a></li>
                                                    <li class="<?= PAGE_CONTROLLERS == 'contact' ? 'active' : '' ?>"><a href="<?= ADDRESS ?>contact.html">CONTACT US</a></li>
                                                </ul>
                                            </div>

                                            <div id="slide">
                                                <article class="demo_block">
                                                    <ul id="demo1">


                                                        <?php
                                                        $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";


                                                        $query = $db->Query($sql);


                                                        while ($row = $db->FetchArray($query)) {
                                                            $image = $slides_file->getDataDescLastID("file_name", "slides_id = '" . $row['id'] . "'");
                                                            ?>
                                                            <li><img src="<?php echo ADDRESS_SLIDES . $image ?>"  /> </li>



                                                        <?php } ?>


                                                    </ul>
                                                </article>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="container box-main-content">
                                        <div class="row box-content <?= PAGE_CONTROLLERS == 'services' ? 'box-services' : '' ?>">

                                            <?php
                                            if (PAGE_CONTROLLERS == '' || PAGE_CONTROLLERS == 'index') {

                                                include 'controllers/home.php';
                                            } else {
                                                include 'controllers/' . PAGE_CONTROLLERS . '.php';
                                            }
                                            ?>


                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2  col-sm-push-10 col-md-2   col-md-push-10  logo-footer"><img src="<?= ADDRESS ?>images/logofooter.jpg" class=""/></div>
                                            <div class="col-xs-12 col-sm-10 col-sm-pull-2 col-md-10 col-md-pull-2 box-footer-detail ">
                                                <p>เรียล เมดิค คลีนิค ถนนมหิดล ต.ป่าแดด อ.เมืองเชียงใหม จ.เชียงใหม่ 50100 ประทเศไทย. โทร : 095-4181820  อีเมล์ :  info@realmedicclinic.com</p>
                                                <p>Copyright (c) 2015 Real Medic Clinic. All rights reserved.</p>
                                            </div>


                                        </div>
                                    </div>

                                    <style>
                                        .navbar-brand{
                                            padding: 0 0 0 10px;
                                        }
                                        .navbar{
                                            margin-bottom: 0;
                                        }

                                        .box-home-detail{
                                            background: url(<?= ADDRESS ?>images/bglefttxtcontant.png) left top repeat;
                                            padding: 0 10px 48px 23px;
                                            margin-bottom: 10px;
                                        }

                                        .box-home-detail > h1{
                                            font-size:  22px;
                                        }

                                        .box-footer-detail{
                                            color: #b2b2b2;
                                            padding-left: 0;
                                        }
                                        .box-footer-detail > p{
                                            font-size: 13px;
                                            margin-bottom: 0px;
                                        }
                                        img{
                                            max-width: 100%;
                                            height: auto;
                                        }
                                        .container{
                                            max-width: 1000px;
                                        }
                                        .box-contact{
                                            padding-left: 0;
                                        }

                                        @media (max-width: 480px) {
                                            .box-contact {
                                                text-align: center;
                                                padding-right: 0;
                                            }
                                            .box-footer-detail{
                                                text-align: center;

                                            }
                                            .logo-footer{
                                                text-align: center;
                                                margin-bottom: 15px;
                                            }

                                        }
                                        @media (max-width: 767px) {
                                            #menu{
                                                display: none;

                                            }
                                        }
                                        @media screen and (min-width: 768px) {
                                            .navbar{
                                                display: none;

                                            } 
                                        }
                                        @media (min-width:768px) and (max-width:800px){
                                            #menu ul {
                                                padding-left: 113px;

                                            }
                                            #menu li{
                                                padding: 0 0 0 38px;
                                            }

                                        }
                                        @media (min-width:801px) and (max-width: 991px) {
                                            #menu ul{
                                                padding-left: 200px;
                                                padding-top: 32px;

                                            } 
                                            #menu li{
                                                padding: 0 0 0 28px;
                                            }

                                        }
                                        @media (min-width:992px) and (max-width: 1100px) {
                                            #menu ul{
                                                padding-left: 203px;
                                                padding-top: 52px;

                                            } 
                                        }
                                        @media (min-width:1101px) and (max-width: 1200px) {
                                            #menu ul{
                                                padding-left: 292px;
                                                padding-top: 25px;

                                            } 
                                        }



                                        /* adjust body when menu is open */
                                        body.slide-active {
                                            overflow-x: hidden
                                        }
                                        /*first child of #page-content so it doesn't shift around*/
                                        .no-margin-top {
                                            margin-top: 0px!important
                                        }
                                        /*wrap the entire page content but not nav inside this div if not a fixed top, don't add any top padding */
                                        #page-content {
                                            position: relative;
                                            padding-top: 70px;
                                            left: 0;
                                        }
                                        #page-content.slide-active {
                                            padding-top: 0
                                        }



                                        /* put toggle bars on the left :: not using button */
                                        #slide-nav .navbar-toggle {
                                            cursor: pointer;
                                            position: relative;
                                            line-height: 0;
                                            float: left;
                                            margin: 0;
                                            width: 30px;
                                            height: 40px;
                                            padding: 10px 0 0 0;
                                            border: 0;
                                            background: transparent;
                                        }
                                        /* icon bar prettyup - optional */
                                        #slide-nav .navbar-toggle > .icon-bar {
                                            width: 100%;
                                            display: block;
                                            height: 3px;
                                            margin: 5px 0 0 0;
                                        }
                                        #slide-nav .navbar-toggle.slide-active .icon-bar {
                                            background: orange
                                        }
                                        .navbar-header {
                                            position: relative
                                        }
                                        /* un fix the navbar when active so that all the menu items are accessible */
                                        .navbar.navbar-fixed-top.slide-active {
                                            position: relative
                                        }
                                        /* screw writing importants and shit, just stick it in max width since these classes are not shared between sizes */
                                        @media screen and (max-width:320px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 20px;

                                            }
                                            .box-content{
                                                margin-bottom: 10px;
                                            }
                                            #page-content{
                                                padding-top: 0;
                                            }
                                            #slide-nav .container {
                                                margin: 0!important;
                                                padding: 0!important;
                                                height:100%;
                                            }
                                            #slide-nav .navbar-header {
                                                margin: 0 auto;
                                                padding: 0 15px;
                                            }
                                            #slide-nav .navbar.slide-active {
                                                position: absolute;
                                                width: 80%;
                                                top: -1px;
                                                z-index: 1000;
                                            }
                                            #slide-nav #slidemenu {
                                                background: #f7f7f7;
                                                left: -100%;
                                                width: 80%;
                                                min-width: 0;
                                                position: absolute;
                                                padding-left: 0;
                                                z-index: 2;
                                                top: -8px;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav {
                                                min-width: 0;
                                                width: 100%;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav .dropdown-menu li a {
                                                min-width: 0;
                                                width: 80%;
                                                white-space: normal;
                                            }
                                            #slide-nav {
                                                border-top: 0
                                            }
                                            #slide-nav.navbar-inverse #slidemenu {
                                                background: #333
                                            }
                                            /* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
                                            #navbar-height-col {
                                                position: fixed;
                                                top: 0;
                                                height: 100%;
                                                bottom:0;
                                                width: 80%;
                                                left: -80%;
                                                background: #f7f7f7;
                                            }
                                            #navbar-height-col.inverse {
                                                background: #333;
                                                z-index: 1;
                                                border: 0;
                                            }
                                            #slide-nav .navbar-form {
                                                width: 100%;
                                                margin: 8px 0;
                                                text-align: center;
                                                overflow: hidden;
                                                /*fast clearfixer*/
                                            }
                                            #slide-nav .navbar-form .form-control {
                                                text-align: center
                                            }
                                            #slide-nav .navbar-form .btn {
                                                width: 100%
                                            }
                                        }
                                        @media screen and (min-width:321px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 20px;

                                            }
                                            .box-content{
                                                margin-bottom: 10px;
                                            }
                                            #page-content{
                                                padding-top: 0;
                                            }
                                            #slide-nav .container {
                                                margin: 0!important;
                                                padding: 0!important;
                                                height:100%;
                                            }
                                            #slide-nav .navbar-header {
                                                margin: 0 auto;
                                                padding: 0 15px;
                                            }
                                            #slide-nav .navbar.slide-active {
                                                position: absolute;
                                                width: 80%;
                                                top: -1px;
                                                z-index: 1000;
                                            }
                                            #slide-nav #slidemenu {
                                                background: #f7f7f7;
                                                left: -100%;
                                                width: 80%;
                                                min-width: 0;
                                                position: absolute;
                                                padding-left: 0;
                                                z-index: 2;
                                                top: -8px;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav {
                                                min-width: 0;
                                                width: 100%;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav .dropdown-menu li a {
                                                min-width: 0;
                                                width: 80%;
                                                white-space: normal;
                                            }
                                            #slide-nav {
                                                border-top: 0
                                            }
                                            #slide-nav.navbar-inverse #slidemenu {
                                                background: #333
                                            }
                                            /* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
                                            #navbar-height-col {
                                                position: fixed;
                                                top: 0;
                                                height: 100%;
                                                bottom:0;
                                                width: 80%;
                                                left: -80%;
                                                background: #f7f7f7;
                                            }
                                            #navbar-height-col.inverse {
                                                background: #333;
                                                z-index: 1;
                                                border: 0;
                                            }
                                            #slide-nav .navbar-form {
                                                width: 100%;
                                                margin: 8px 0;
                                                text-align: center;
                                                overflow: hidden;
                                                /*fast clearfixer*/
                                            }
                                            #slide-nav .navbar-form .form-control {
                                                text-align: center
                                            }
                                            #slide-nav .navbar-form .btn {
                                                width: 100%
                                            }
                                        }
                                        @media screen and (min-width:480px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 30px;

                                            }
                                            .box-content {
                                                margin-bottom: 10px;
                                            }
                                            #page-content{
                                                padding-top: 0;
                                            }
                                            #slide-nav .container {
                                                margin: 0!important;
                                                padding: 0!important;
                                                height:100%;
                                            }
                                            #slide-nav .navbar-header {
                                                margin: 0 auto;
                                                padding: 0 15px;
                                            }
                                            #slide-nav .navbar.slide-active {
                                                position: absolute;
                                                width: 80%;
                                                top: -1px;
                                                z-index: 1000;
                                            }
                                            #slide-nav #slidemenu {
                                                background: #f7f7f7;
                                                left: -100%;
                                                width: 80%;
                                                min-width: 0;
                                                position: absolute;
                                                padding-left: 0;
                                                z-index: 2;
                                                top: -8px;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav {
                                                min-width: 0;
                                                width: 100%;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav .dropdown-menu li a {
                                                min-width: 0;
                                                width: 80%;
                                                white-space: normal;
                                            }
                                            #slide-nav {
                                                border-top: 0
                                            }
                                            #slide-nav.navbar-inverse #slidemenu {
                                                background: #333
                                            }
                                            /* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
                                            #navbar-height-col {
                                                position: fixed;
                                                top: 0;
                                                height: 100%;
                                                bottom:0;
                                                width: 80%;
                                                left: -80%;
                                                background: #f7f7f7;
                                            }
                                            #navbar-height-col.inverse {
                                                background: #333;
                                                z-index: 1;
                                                border: 0;
                                            }
                                            #slide-nav .navbar-form {
                                                width: 100%;
                                                margin: 8px 0;
                                                text-align: center;
                                                overflow: hidden;
                                                /*fast clearfixer*/
                                            }
                                            #slide-nav .navbar-form .form-control {
                                                text-align: center
                                            }
                                            #slide-nav .navbar-form .btn {
                                                width: 100%
                                            }
                                        }
                                        @media  screen and (min-width:767px) {
                                            .box-main-content{
                                                position: relative;
                                                bottom: 53px;

                                            }
                                            .box-content {
                                                margin-bottom: 0;
                                            }
                                            #page-content{
                                                padding-top: 0;
                                            }
                                            #slide-nav .container {
                                                margin: 0!important;
                                                padding: 0!important;
                                                height:100%;
                                            }
                                            #slide-nav .navbar-header {
                                                margin: 0 auto;
                                                padding: 0 15px;
                                            }
                                            #slide-nav .navbar.slide-active {
                                                position: absolute;
                                                width: 80%;
                                                top: -1px;
                                                z-index: 1000;
                                            }
                                            #slide-nav #slidemenu {
                                                background: #f7f7f7;
                                                left: -100%;
                                                width: 80%;
                                                min-width: 0;
                                                position: absolute;
                                                padding-left: 0;
                                                z-index: 2;
                                                top: -8px;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav {
                                                min-width: 0;
                                                width: 100%;
                                                margin: 0;
                                            }
                                            #slide-nav #slidemenu .navbar-nav .dropdown-menu li a {
                                                min-width: 0;
                                                width: 80%;
                                                white-space: normal;
                                            }
                                            #slide-nav {
                                                border-top: 0
                                            }
                                            #slide-nav.navbar-inverse #slidemenu {
                                                background: #333
                                            }
                                            /* this is behind the navigation but the navigation is not inside it so that the navigation is accessible and scrolls*/
                                            #navbar-height-col {
                                                position: fixed;
                                                top: 0;
                                                height: 100%;
                                                bottom:0;
                                                width: 80%;
                                                left: -80%;
                                                background: #f7f7f7;
                                            }
                                            #navbar-height-col.inverse {
                                                background: #333;
                                                z-index: 1;
                                                border: 0;
                                            }
                                            #slide-nav .navbar-form {
                                                width: 100%;
                                                margin: 8px 0;
                                                text-align: center;
                                                overflow: hidden;
                                                /*fast clearfixer*/
                                            }
                                            #slide-nav .navbar-form .form-control {
                                                text-align: center
                                            }
                                            #slide-nav .navbar-form .btn {
                                                width: 100%
                                            }
                                        }
                                        @media (min-width:768px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 53px;

                                            }
                                            #page-content{
                                                padding-top: 0;
                                            }
                                            #page-content {
                                                left: 0!important
                                            }
                                            .navbar.navbar-fixed-top.slide-active {
                                                position: fixed
                                            }
                                            .navbar-header {
                                                left: 0!important
                                            }
                                        }
                                        @media (min-width:992px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 70px;

                                            }


                                        }
                                        @media (min-width:1200px) { 
                                            .box-main-content{
                                                position: relative;
                                                bottom: 0px;

                                            }
                                        }
                                        .navbar-inverse {
                                            background-color: #69417D;
                                            border-color: #56256F; 
                                        }
                                        .navbar-inverse .navbar-brand {
                                            color: #f7f7f7;
                                        }
                                        a{
                                            text-decoration: none;
                                        }



                                    </style>



                                    <script>
                                        $(function () {
                                            var demo1 = $("#demo1").slippry({
                                                transition: 'fade',
                                                useCSS: true,
                                                speed: 1000,
                                                pause: 3000,
                                                auto: true,
                                                preload: 'visible'
                                            });

                                            $('.stop').click(function () {
                                                demo1.stopAuto();
                                            });

                                            $('.start').click(function () {
                                                demo1.startAuto();
                                            });

                                            $('.prev').click(function () {
                                                demo1.goToPrevSlide();
                                                return false;
                                            });
                                            $('.next').click(function () {
                                                demo1.goToNextSlide();
                                                return false;
                                            });
                                            $('.reset').click(function () {
                                                demo1.destroySlider();
                                                return false;
                                            });
                                            $('.reload').click(function () {
                                                demo1.reloadSlider();
                                                return false;
                                            });
                                            $('.init').click(function () {
                                                demo1 = $("#demo1").slippry();
                                                return false;
                                            });
                                        });
                                    </script>
                                    <script>
                                        $(document).ready(function () {


                                            //stick in the fixed 100% height behind the navbar but don't wrap it
                                            $('#slide-nav.navbar-inverse').after($('<div class="inverse" id="navbar-height-col"></div>'));

                                            $('#slide-nav.navbar-default').after($('<div id="navbar-height-col"></div>'));

                                            // Enter your ids or classes
                                            var toggler = '.navbar-toggle';
                                            var pagewrapper = '#page-content';
                                            var navigationwrapper = '.navbar-header';
                                            var menuwidth = '100%'; // the menu inside the slide menu itself
                                            var slidewidth = '80%';
                                            var menuneg = '-100%';
                                            var slideneg = '-80%';


                                            $("#slide-nav").on("click", toggler, function (e) {

                                                var selected = $(this).hasClass('slide-active');

                                                $('#slidemenu').stop().animate({
                                                    left: selected ? menuneg : '0px'
                                                });

                                                $('#navbar-height-col').stop().animate({
                                                    left: selected ? slideneg : '0px'
                                                });

                                                $(pagewrapper).stop().animate({
                                                    left: selected ? '0px' : slidewidth
                                                });

                                                $(navigationwrapper).stop().animate({
                                                    left: selected ? '0px' : slidewidth
                                                });


                                                $(this).toggleClass('slide-active', !selected);
                                                $('#slidemenu').toggleClass('slide-active');


                                                $('#page-content, .navbar, body, .navbar-header').toggleClass('slide-active');


                                            });


                                            var selected = '#slidemenu, #page-content, body, .navbar, .navbar-header';


                                            $(window).on("resize", function () {

                                                if ($(window).width() > 767 && $('.navbar-toggle').is(':hidden')) {
                                                    $(selected).removeClass('slide-active');
                                                }


                                            });
                                        });
                                    </script>

                                </body>
                                </html>
