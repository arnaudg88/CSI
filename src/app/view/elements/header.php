<?php
$r = \Slim\Slim::getInstance();
$dir = dirname($_SERVER['SCRIPT_NAME']);
$dirJs = $dir.'/js/';
$dirCss = $dir.'/css/';
$dirImg = $dir.'/images/';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <?php
    echo '
    <link rel="icon" href="'.$dirImg.'favicon.ico">
    <link rel="shortcut icon" href="'.$dirImg.'favicon.ico" />
    <link rel="stylesheet" href="'.$dirCss.'owl.carousel.css">
    <link rel="stylesheet" href="'.$dirCss.'contact-form.css">
    <link rel="stylesheet" href="'.$dirCss.'camera.css">
    <link rel="stylesheet" href="'.$dirCss.'style.css">
    <script src="'.$dirJs.'jquery.js"></script>
    <script src="'.$dirJs.'jquery-migrate-1.1.1.js"></script>
    <script src="'.$dirJs.'jquery.easing.1.3.js"></script>
    <script src="'.$dirJs.'script.js"></script>
    <script src="'.$dirJs.'superfish.js"></script>
    <script src="'.$dirJs.'jquery.equalheights.js"></script>
    <script src="'.$dirJs.'jquery.mobilemenu.js"></script>
    <script src="'.$dirJs.'tmStickUp.js"></script>
    <script src="'.$dirJs.'jquery.ui.totop.js"></script>
    <script src="'.$dirJs.'camera.js"></script>
    <script src="'.$dirJs.'owl.carousel.js"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="'.$dirJs.'jquery.mobile.customized.min.js"></script>';
?>
    <!--<![endif]-->
    <script>
        $(window).load(function() {
            $().UItoTop({easingType: 'easeOutQuart'});
            $('#stuck_container').tmStickUp({});

            $('#camera_wrap').camera({
                loader: false,
                pagination: false,
                minHeight: '400',
                thumbnails: false,
                height: '38.07291666666667%',
                caption: false,
                navigation: true,
                fx: 'mosaic'
            });

            $("#owl").owlCarousel({
                items: 3, //10 items above 1000px browser width
                itemsDesktop: [995, 1], //5 items between 1000px and 901px
                itemsDesktopSmall: [767, 1], // betweem 900px and 601px
                itemsTablet: [700, 1], //2 items between 600 and 0
                itemsMobile: [479, 1], // itemsMobile disabled - inherit from itemsTablet option
                navigation: true,
                pagination: false
            });
        });
    </script>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <?php echo '<script src="'.$dirJs.'html5shiv.js"></script>'; ?>
    <link rel="stylesheet" media="screen" href="css/ie.css">
    <![endif]-->
</head>
<body class="page1" id="top">
<!--==============================
header
=================================-->
<header>
    <div class="container_12">
        <div class="grid_12">
            <h1 class="logo">
                <?php
                echo '<a href="'.$r->urlFor('home').'">';
                ?>
                    ENCHERES FUN
                    <span>Le site d'enchères qui répertorie les meilleures offres !</span>
                </a>
            </h1>
        </div>
        <div class="clear"></div>
    </div>
    <section id="stuck_container">
        <!--==============================
        Stuck menu
        =================================-->
        <div class="container_12">
            <div class="grid_12">
                <div class="navigation">
                    <nav>
                        <ul class="sf-menu">
                            <?php


                            echo '<li><a href="'.$r->urlFor('home').'">Accueil</a></li>
                            <li><a href="'.$r->urlFor('encheres').'">Les enchères</a></li>
                            <li><a href="'.$r->urlFor('home').'">A propos</a></li>';

                            if(isset($_SESSION['util'])) {
                                echo '<li><a href="'.$r->urlFor('addProduit').'">Ajouter produit</a></li>
                                <li><a href="'.$r->urlFor('profil').'">Bonjour '.$_SESSION['util']->pseudo.' ('.$_SESSION['util']->soldeDisp.'€)</a></li>
                                <li><a href="'.$r->urlFor('deconnexion').'">Déconnexion</a></li>';
                            } else {
                                echo '<li><a href="'.$r->urlFor('inscription').'">Inscription</a></li>
                                <li><a href="'.$r->urlFor('connexion').'">Connexion</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
</header>
