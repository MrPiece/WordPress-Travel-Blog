<!DOCTYPE html>
<html lang="<?php language_attributes() ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head() ?>

  <?php if ( is_user_logged_in() ): ?>
    <style>
      #slideout-menu {
        padding-top: 52px;
      }

      @media (max-width: 782px) {
        #slideout-menu {
          padding-top: 66px;
        }
      }
    </style>
  <?php endif ?>

  <title><?php wp_title(' | ') ?></title>
</head>

<body>
  <nav id="slideout-menu">
    <ul class="links-list">
      <li class="menu-item"><a href="<?= get_home_url() . '//contact/' ?>" class="link-title">Learn more</a></li>
      <?php
      $menu_args = [
        'theme_location'  => 'mobile-about',
        'menu'            => 'mobile_about',
        'menu_class'      => 'links-list',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'echo'            => true,
      ];
      wp_nav_menu($menu_args); 
      ?>
    </ul>

    <hr>

    <ul class="links-list">
      <li class="menu-item"><a href="<?= get_home_url() . '/blog/' ?>" class="link link-title">Blog</a></li>
      <?php
      $menu_args = [
        'theme_location'  => 'mobile-blog',
        'menu'            => 'mobile_blog',
        'menu_class'      => 'links-list',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'echo'            => true,
      ];
      wp_nav_menu($menu_args); 
      ?>
    </ul>

    <hr>

    <ul class="social-links">
      <a href="<?= get_custom('facebook_link') ?>"><i class="fab fa-facebook-f"></i></a>
      <a href="<?= get_custom('twitter_link') ?>"><i class="fab fa-twitter"></i></a>
      <a href="<?= get_custom('instagram_link') ?>"><i class="fab fa-instagram"></i></a>
      <a href="<?= get_custom('pinterest_link') ?>"><i class="fab fa-pinterest-p"></i></a>
      <a href="<?= get_home_url() . '/contact/' ?>"><i class="fas fa-envelope"></i></a>
    </ul>
  </nav>

  <div id="slideout-panel">
    <div class="background home-header" style="background-image: url(<?= MEDIA . 'home-header.jpg' ?>);">
      <div class="background-darken">
        <div class="container">
          <header class="header header_transparent">
            <div class="container">
              <nav class="header__nav">
                <h2 class="header__brand">
                  <a href="<?= get_home_url() ?>"><?php bloginfo('name') ?></a>
                </h2>
        
                <?php 
                $menu_args = [
                  'theme_location'  => 'header',
                  'menu'            => 'header_menu',
                  'menu_class'      => 'links-list',
                  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					      	'echo'            => true,
                ];
                wp_nav_menu($menu_args); 
                
                
                get_search_form();
                ?>   
        
                <i class="fas fa-bars header__menu-icon"></i>
        
                <i class="fas fa-search header__search-mobile-icon" id="search-icon"></i>
                <form class="header__search-mobile" id="mobile-search" action="#" method="get">
                  <input class="header__search-mobile-input" type="search" placeholder="Search...">
                  <button type="submit" class="header__search-mobile-button">
                    <i class="fas fa-search search-icon header__search-icon"></i>
                  </button>
                </form>
              </nav>
            </div>
          </header>

          <div class="intro intro_right">
            <h1 class="intro__title"><?= get_custom('motto') ?></h1>
            <p class="intro__text"><?php bloginfo('description') ?></p>
            <div class="intro__buttons">
              <a href="#latest-posts" class="action-button" draggable="false">Latest posts</a>
              <a href="#about-me" class="action-button" draggable="false">About me</a>
            </div>
          </div>
        </div>
      </div>
    </div>