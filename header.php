<!DOCTYPE html>
<html lang="en_US">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- k<title>Fictional University</title>     -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>   
    
    <header class="site-header">
      <div class="container">
        <h1 class="school-logo-text float-left">
            <a href="<?php echo site_url() ?>" class=" hover:text-3xl text-blue-400" ><?php esc_html__(bloginfo('name') ,'FU_domain'); ?></a>
        </h1>

        <a href="<?php echo site_url('/search') ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
            <?php
            //wp_nav_menu(['theme_location'=>'headerMenuLocation']); 
            ?>
            <ul>
              <li <?php if(is_page('about-us') or wp_get_post_parent_id(0) == 30) echo 'class="current-menu-item"' ?>>
                <a href="<?php echo site_url('/about-us') ?>"><?php echo esc_html__('About Us' ,'FU_domain'); ?></a></li>
              
              <li <?php if(get_post_type()=='program' or is_page('program')) echo 'class="current-menu-item"' ?>>
                <a href="<?php echo site_url('/program'); ?>"><?php echo esc_html__('Programs' ,'FU_domain'); ?></a></li>
              
              <li <?php if(get_post_type()=='event' or is_page('past-events')) echo 'class="current-menu-item"' ?>>
                <a href="<?php echo get_post_type_archive_link('event') ?>"><?php echo esc_html__('Events' ,'FU_domain'); ?></a></li>

              <li <?php if(get_post_type()=='campus' or is_page('campus')) echo 'class="current-menu-item"' ?>>
                <a href="<?php echo get_post_type_archive_link('campus'); ?>"><?php echo esc_html__('Campuses' ,'FU_domain'); ?></a></li>

              <li <?php if(get_post_type()=='post') echo 'class="current-menu-item"' ?>>
                <a href="<?php echo site_url('/blog') ?>"><?php echo esc_html__('Blog' ,'FU_domain'); ?></a></li>
              <li>
                  <select name="" id="LanguageList" >
                    <option value="zh_TW">中文</option>
                    <option value="en_US">English</option>
                  </select>
              </li>
            </ul>            
          </nav>
          <div class="site-header__util">
            <?php
            if(is_user_logged_in()){
              ?>  
              <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small btn--dark-orange float-left btn--with-photo">
              <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(),60) ?></span>
              <span class="btn__text">Log out</span>
              </a>
              <?php
            }
            else{
              ?>
              <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
              <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
              <?php
            }
            ?>            
            <a href="<?php echo site_url('/search') ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </header>
