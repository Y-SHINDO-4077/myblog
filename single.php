<?php get_header(); ?>


<div class="single_content">

<article>
  <div class="bread"><?php breadcrumb(); ?></div>

    <?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->

      <?php while ( have_posts() ) : the_post(); ?> <!-- 繰り返しを開始。記事がある場合は、その中から一つめを取得 -->
        <?php the_category(); ?>  <!-- カテゴリーを表示 -->
        <h2><?php the_title(); ?></h2>              <!-- タイトルを表示する -->
        <div class="date"><?php the_time('Y-n-j'); ?></div>              <!-- 日付を表示 -->

        <?php if(has_post_thumbnail()){
          the_post_thumbnail('category-medium');
        }else{ ?>
        <img src="https://via.placeholder.com/700" alt="">
      <?php } ?>                                    <!-- 画像の表示-->
      <?php echo esc_html(get_post_meta($post->ID,'test',true)); ?> <!-- 任意カスタムフィールドの表示-->
      <div class="content-single"><?php the_content(); ?></div>                     <!-- 本文を表示する -->
      <?php
      $id= SCF::get('demoname');
      echo esc_html($id);
      ?><!--Smart Custom Fieldsを用いたカスタムフィールドの表示 -->


      <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->

    <?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
      <p>記事がありません</p>                     <!-- この内容を表示 -->
    <?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->



  </article>
  <?php
  get_sidebar();
  get_footer(); ?>
