<?php
require 'base/db/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= SITE ?> - Shop</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Favicon -->
  <link rel="icon" href="<?= BASE_IMG . "/favicon.png" ?>">

  <!-- Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/bootstrap.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/font-awesome.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/owl.carousel.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/animate.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/jquery-ui.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/slick.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/chosen.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/pe-icon-7-stroke.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/magnific-popup.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/lightbox.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_JS . "/fancybox/source/jquery.fancybox.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/jquery.scrollbar.min.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/mobile-menu.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_FONTS . "/flaticon/flaticon.css" ?>" />
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/style.css" ?>" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

</head>

<body>
  <!-- HEADER -->
  <header class="header style7">
    <div class="top-bar">
      <div class="container">
        <div class="top-bar-left">
          <div class="header-message">Welcome to our online store!</div>
        </div>
        <div class="top-bar-right">
          <!-- Language -->
          <!-- <div class="header-language">
            <div class="cleric-language cleric-dropdown">
              <a href="#" class="active language-toggle" data-cleric="cleric-dropdown">
                <span> English </span>
              </a>
              <ul class="cleric-submenu">
                <li class="switcher-option">
                  <a href="#">
                    <span> English </span>
                  </a>
                </li>
                <li class="switcher-option">
                  <a href="#">
                    <span> Portuguese </span>
                  </a>
                </li>
              </ul>
            </div>
          </div> -->
          <ul class="header-user-links">
            <li>
              <?php if (isset($_SESSION['customer_email'])) : ?>
              <a>
                <i class="fas fa-user"></i>
                <?= $_SESSION['customer_name']; ?>
              </a>
              <?php else : ?>
              <a href="/login">
                <i class="fas fa-user"></i>
                Login | Registrar
              </a>
              <?php endif; ?>
              <!-- <a href="login.html"> <i class="fas fa-user"></i> Login or Register</a> -->
            </li>
          </ul>

          <?php if (isset($_SESSION['customer_email'])) : ?>
          <ul class="header-user-links">
            <li style="cursor: pointer" onclick="exitLogin()">
              <a> <i class="fas fa-sign-in-alt"></i> Sair</a>
              <!-- <a href="login.html"> <i class="fas fa-user"></i> Login or Register</a> -->
            </li>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="main-header">
        <div class="row">
          <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
            <div class="logo">
              <a href="/">
                <img src="<?= BASE_IMG . "/logo.png" ?>" alt="img" />
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
            <div class="block-search-block">
              <form class="form-search form-search-width-category" id="searchForm" onsubmit="redirectToSearch(event)">
                <div class="form-content">
                  <div class="inner">
                    <input type="text" id="searchInput" class="input" name="search" value=""
                      placeholder="Search here" />
                  </div>
                  <button class="btn-search" type="submit">
                    <span class="icon-search"></span>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
            <div class="header-control">
              <div class="block-minicart cleric-mini-cart block-header cleric-dropdown">
                <a href="/shoppingCart" class="shopcart-icon">
                  Cart
                  <span class="count"> 0 </span>
                </a>
              </div>

              <div class="block-minicart cleric-mini-cart block-header cleric-dropdown">
                <a href="/favorites" style="font-size: 2.3rem" class="far fa-heart heart-icon">
                  <span class="count" id="countFavorites"> 0 </span>
                </a>
              </div>
              <a class="menu-bar mobile-navigation menu-toggle" href="#">
                <span></span>
                <span></span>
                <span></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav-container">
      <div class="container">
        <div class="header-nav-wapper main-menu-wapper">
          <div class="vertical-wapper block-nav-categori">
            <div class="block-title">
              <span class="icon-bar">
                <span></span>
                <span></span>
                <span></span>
              </span>
              <span class="text">Categories</span>
            </div>
            <div class="block-content verticalmenu-content">
              <ul class="cleric-nav-vertical vertical-menu cleric-clone-mobile-menu">
                <li class="menu-item">
                  <a href="#" class="cleric-menu-item-title" title="New Arrivals">New Arrivals</a>
                </li>
                <li class="menu-item">
                  <a title="Hot Sale" href="#" class="cleric-menu-item-title">Hot Sale</a>
                </li>
                <?php
                $get_categories = $pdo->prepare("SELECT * FROM category WHERE visibility_category = 'Visible' ORDER BY RAND() LIMIT 5 ");
                $get_categories->execute();

                while ($category = $get_categories->fetch(PDO::FETCH_ASSOC)) {

                  extract($category);

                  echo "
                  <li class='menu-item'>
                    <a title='$name_category' class='cleric-menu-item-title' href='/products/category/$name_category'>$name_category</a>
                  </li>
                ";
                }
                ?>
                <!-- <li class="menu-item menu-item-has-children">
                    <a title="Accessories" href="#" class="cleric-menu-item-title">Accessories</a>
                    <span class="toggle-submenu"></span>
                    <ul role="menu" class="submenu">
                      <li class="menu-item">
                        <a title="Living" href="#" class="cleric-item-title">Living</a>
                      </li>
                      <li class="menu-item">
                        <a title="Accents" href="#" class="cleric-item-title">Accents</a>
                      </li>
                      <li class="menu-item">
                        <a title="New Arrivals" href="#" class="cleric-item-title">New Arrivals</a>
                      </li>
                      <li class="menu-item">
                        <a title="Accessories" href="#" class="cleric-item-title">Accessories</a>
                      </li>
                      <li class="menu-item">
                        <a title="Bedroom" href="#" class="cleric-item-title">Bedroom</a>
                      </li>
                    </ul>
                  </li> -->
              </ul>
            </div>
          </div>
          <div class="header-nav">
            <div class="container-wapper">
              <ul class="cleric-clone-mobile-menu cleric-nav main-menu" id="menu-main-menu">
                <li class="menu-item">
                  <a href="/" class="cleric-menu-item-title" title="Home">Home</a>
                </li>
                <li class="menu-item">
                  <a href="/about" class="cleric-menu-item-title" title="About">About</a>
                </li>
                <li class="menu-item">
                  <a href="/products" class="cleric-menu-item-title" title="Shop">Shop</a>
                </li>
                <li class="menu-item">
                  <a href="/contact" class="cleric-menu-item-title" title="Contact">Contact</a>
                </li>
                <!-- <li class="menu-item">
                  <a href="blog_list.html" class="cleric-menu-item-title" title="Blog">Blog</a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- HEADER DEVICE -->
  <div class="header-device-mobile">
    <div class="wapper">
      <div class="item mobile-logo">
        <div class="logo">
          <a href="#">
            <img src="assets/images/logo.png" alt="img" />
          </a>
        </div>
      </div>
      <div class="item item mobile-search-box has-sub">
        <a href="#">
          <span class="icon">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </a>
        <div class="block-sub">
          <a href="#" class="close">
            <i class="fa fa-times" aria-hidden="true"></i>
          </a>
          <div class="header-searchform-box">
            <form class="header-searchform">
              <div class="searchform-wrap">
                <input type="text" class="search-input" placeholder="Enter keywords to search..." />
                <input type="submit" class="submit button" value="Search" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="item mobile-settings-box has-sub">
        <a href="#">
          <span class="icon">
            <i class="fa fa-cog" aria-hidden="true"></i>
          </span>
        </a>
        <div class="block-sub">
          <a href="#" class="close">
            <i class="fa fa-times" aria-hidden="true"></i>
          </a>
          <div class="block-sub-item">
            <h5 class="block-item-title">Currency</h5>
            <form class="currency-form cleric-language">
              <ul class="cleric-language-wrap">
                <li class="active">
                  <a href="#">
                    <span> English </span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span> Portuguese </span>
                  </a>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
      <div class="item menu-bar">
        <a class="mobile-navigation menu-toggle" href="#">
          <span></span>
          <span></span>
          <span></span>
        </a>
      </div>
    </div>
  </div>

  <!-- MAIN -->
  <?= $this->section("content") ?>

  <!-- FOOTER -->
  <footer class="footer style7">
    <div class="container">
      <div class="container-wapper">
        <div class="row">
          <!-- newsletter -->
          <!-- <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-sm hidden-md hidden-lg">
            <div class="cleric-newsletter style1">
              <div class="newsletter-head">
                <h3 class="title">Newsletter</h3>
              </div>
              <div class="newsletter-form-wrap">
                <div class="list">
                  Sign up for our newsletter to <br /> receive updates on our products
                </div>
                <input type="email" class="input-text email email-newsletter" placeholder="Your email letter" />
                <button class="button btn-submit submit-newsletter">
                  SUBSCRIBE
                </button>
              </div>
            </div>
          </div> -->
          <!-- Categorias -->
          <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="cleric-custommenu default">
              <h2 class="widgettitle">Quick Menu</h2>
              <ul class="menu">
                <?php
                $get_categories = $pdo->prepare("SELECT * FROM category WHERE visibility_category = 'Visible' LIMIT 5");
                $get_categories->execute();

                while ($category = $get_categories->fetch(PDO::FETCH_ASSOC)) {

                  extract($category);

                  echo "
                  <li class='menu-item'>
                    <a href='/products/category/$name_category'>$name_category</a>
                  </li>
                ";
                }
                ?>
              </ul>
            </div>
          </div>

          <!-- NewsLatter -->
          <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs">
            <div class="cleric-newsletter style1">
              <div class="newsletter-head">
                <h3 class="title">Best Online Shop</h3>
              </div>
              <div class="newsletter-form-wrap">
                <div class="list">
                  In this store you will find the best and most affordable products

                </div>
                <!-- <input type="email" class="input-text email email-newsletter" placeholder="Your email letter" />
                <button class="button btn-submit submit-newsletter">
                  SUBSCRIBE
                </button> -->
              </div>
            </div>
          </div>

          <!-- Links -->
          <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="cleric-custommenu default">
              <h2 class="widgettitle">Information</h2>
              <ul class="menu">
                <li class="menu-item">
                  <a href="/myOrders">My Orders</a>
                </li>
                <li class="menu-item">
                  <a href="/contact">Contact Us</a>
                </li>
                <li class="menu-item">
                  <a href="/about">Return</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-end">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div class="cleric-socials">
                <ul class="socials">
                  <li>
                    <a href="#" class="social-item" target="_blank">
                      <i class="icon fa fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="social-item" target="_blank">
                      <i class="icon fa fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="social-item" target="_blank">
                      <i class="icon fa fa-youtube"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="coppyright">
                Copyright © 2023
                <a href="http://tchossy.com/">Tchossy</a>
                . All rights reserved
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- FOOTER DEVICE -->
  <div class="footer-device-mobile">
    <div class="wapper">
      <div class="footer-device-mobile-item device-home">
        <a href="/">
          <span class="icon">
            <i class="fa fa-home" aria-hidden="true"></i>
          </span>
          Home
        </a>
      </div>
      <div class="footer-device-mobile-item device-home device-wishlist">
        <a href="/favorites">
          <span class="icon">
            <i class="fa fa-heart" aria-hidden="true"></i>
          </span>
          Wishlist
        </a>
      </div>
      <div class="footer-device-mobile-item device-home device-cart">
        <a href="/shoppingCart">
          <span class="icon">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <span class="count-icon"> 0 </span>
          </span>
          <span class="text">Cart</span>
        </a>
      </div>
      <div class="footer-device-mobile-item device-home device-user">
        <a href="/login">
          <span class="icon">
            <i class="fa fa-user" aria-hidden="true"></i>
          </span>
          Account
        </a>
      </div>
    </div>
  </div>

  <!-- BACK TO TOP -->
  <a href="#" class="backtotop">
    <i class="fa fa-angle-double-up"></i>
  </a>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?= BASE_JS . "/jquery.min.js" ?>"></script>

  <script src="<?= BASE_JS . "/jquery-1.12.4.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery.plugin-countdown.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery-countdown.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/bootstrap.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/owl.carousel.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/magnific-popup.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/isotope.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery.scrollbar.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery-ui.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/mobile-menu.js"  ?>"></script>
  <script src="<?= BASE_JS . "/chosen.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/slick.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery.elevateZoom.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery.actual.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/fancybox/source/jquery.fancybox.js"  ?>"></script>
  <script src="<?= BASE_JS . "/lightbox.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/owl.thumbs.min.js"  ?>"></script>
  <script src="<?= BASE_JS . "/jquery.scrollbar.min.js"  ?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM"></script>
  <script src="<?= BASE_JS . "/frontend-plugin.js"  ?>"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script src="<?= BASE_ACTIONS . "/actions_logout.js" ?>"></script>
  <script src="<?= BASE_ACTIONS . "/actions_search_reditect.js" ?>"></script>
  <script src="<?= BASE_ACTIONS . "/actions_favorite.js" ?>"></script>


</body>

</html>