<?php get_header();?>

<div class="content">


<?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->

  <?php while ( have_posts() ) : the_post(); ?> <!-- 繰り返しを開始。記事がある場合は、その中から一つめを取得 -->
    <h2><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>              <!-- タイトルを表示する -->
    <?php the_time('Y-n-j'); ?>              <!-- 日付を表示 -->
    <?php if(has_post_thumbnail()){
      the_post_thumbnail('category-big');
    }else{ ?>
    <img src="https://via.placeholder.com/700" alt="">
  <?php } ?>

    <hr>                                        <!-- 記事毎に区切り線 -->
  <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->


<?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
  <p>記事がありません</p>                     <!-- この内容を表示 -->
<?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->
</div>

<?php get_footer(); ?>
