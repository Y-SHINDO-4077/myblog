<!DOCTYPE html>
<html lang="ja">
<?php wp_head(); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
</head>
<?php wp_footer(); ?>
<body <?php body_class(); ?>>

    <div class="main">

      <h1 class="title"><?php bloginfo('name'); ?></h1>
      <!--スマホ用メニューボタン-->
     <div class="header_menu">
      <button type="button" id="navbutton" class="navbutton">
         <i class="fas fa-bars"></i>
      </button>
      <p style="margin:0;">MENU</p>
      <div class="nav" id="header-nav-wrap">
        <?php wp_nav_menu('theme_location=primary_menu'); ?>
      </div>
     </div>
    <?php if(is_front_page()): ?>
      <div class="img_top">
      <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="" width="1000" height="550">
      </div>
    <?php endif; ?>
