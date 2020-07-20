<?php get_header();?>

<div class="content">
  <div class="bread"><?php breadcrumb(); ?></div>
  <h1 class="post_title">タグ: <?php
  if(is_month()){
    echo get_the_date('Y年n月');
  }else{
    echo get_the_archive_title();
  }
   ?>の記事一覧</h1>

  <?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->
   <div class="grid">

    <?php while ( have_posts() ) : the_post(); ?> <!-- 繰り返しを開始。記事がある場合は、その中から一つめを取得 -->
      <div class="items">
      <h2><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>              <!-- タイトルを表示する -->
      <p><?php the_time('Y-n-j'); ?></p>   <!-- 日付を表示 -->
    <div class="img">
      <?php if(has_post_thumbnail()){
        the_post_thumbnail('medium');
      }else{ ?>
      <img src="https://via.placeholder.com/300" alt="" class="img_top-vw">
      <?php } ?>
      </div>
     </div>
      <!-- <hr>         -->                       <!-- 記事毎に区切り線 -->
    <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->
   </div>
  <?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
    <p>記事がありません</p>                     <!-- この内容を表示 -->
  <?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->




  </div>


<?php
get_footer(); ?>
